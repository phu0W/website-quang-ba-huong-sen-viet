<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Lesson;
use App\Models\Course;
use Str;
use Auth;
use Google\Client;
use Google\Service\YouTube as YouTubeService;
use Google\Service\YouTube\Video;
use Google\Service\YouTube\VideoSnippet;
use Google\Service\YouTube\VideoStatus;

class LessonController extends Controller
{
    
    
    public function index()
    {
        $stt=1;
        if (Auth::user()->role->name === 'teacher') {
            $courseIds = Course::where('teacher_id', Auth::id())->pluck('id');
            $lessons = Lesson::with(['course', 'chapter'])
            ->whereIn('course_id', $courseIds)
            ->orderBy('course_id')
            ->orderBy('chapter_id')
            ->orderBy('order_number', 'asc')
            ->get();
        } else {
            $lessons = Lesson::with(['course', 'chapter'])
            ->orderBy('course_id')
            ->orderBy('chapter_id')
            ->orderBy('order_number', 'asc')
            ->get();
        }
        return view('admin.lesson.index',compact('stt','lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role->name === 'teacher') {
            $courses = Course::where('teacher_id', Auth::id())->get();
        } else {
            $courses = Course::all();
        }
        return view('admin.lesson.add', compact('courses'));
    }

    public function getChaptersByCourse(Course $course)
    {
        return response()->json($course->chapters()->select('id', 'title')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'order_number' => 'required|numeric|min:1',
            'course_id' => 'required',
            'chapter_id' => 'required',
            'file' => 'required|mimetypes:video/*',
            'percent' => 'required|numeric|min:1'
        ], [
            'name.required' => 'Bạn chưa nhập tên bài học!',
            'order_number.required' => 'Bạn chưa nhập thứ tự bài học!',
            'course_id.required' => 'Chưa chọn khóa học!',
            'chapter_id.required' => 'Chưa chọn chương học!',
            'file.required' => 'Bạn chưa chọn video!',
        ]);
        try {
            // Thiết lập Google Client
            $client = new \Google_Client();
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
            //lấy accesstoken thông qua refresh token
            $client->setAccessToken([
                'access_token' => Http::post('https://oauth2.googleapis.com/token', [
                    'client_id' => config('services.google.client_id'),
                    'client_secret' => config('services.google.client_secret'),
                    'refresh_token' => config('services.google.refresh_token'),
                    'grant_type' => 'refresh_token',
                ])->json()['access_token']
            ]);
            $client->setScopes(['https://www.googleapis.com/auth/youtube.upload']);//đăng ký scope cho client quyền upload
            $client->setDefer(true);

            $youtube = new \Google_Service_YouTube($client);//khởi tạo service youtube
            //tạo snippet thông tin video
            $snippet = new \Google_Service_YouTube_VideoSnippet();
            $originalFileName = $request->file('file')->getClientOriginalName();
            $snippet->setTitle($originalFileName);
            // $snippet->setDescription("Test upload");
            // $snippet->setCategoryId("27"); //Education
            
            $status = new \Google_Service_YouTube_VideoStatus();
            $status->privacyStatus = "unlisted";
            //Tạo đối tượng video, ghép snippet và status
            $video = new \Google_Service_YouTube_Video();
            $video->setSnippet($snippet);
            $video->setStatus($status);
            $videoPath = $request->file('file')->getRealPath();//lấy đường dẫn thực trên server tạm thời của file video upload từ form
            $chunkSize = 10 * 1024 * 1024;//mỗi chunk upload 10MB
            //tạo request upload
            $insertRequest = $youtube->videos->insert('status,snippet', $video);
            //cấu hình upload video qua nhiều chunk
            $media = new \Google\Http\MediaFileUpload(
                $client,
                $insertRequest,
                'video/*',
                null,
                true,
                $chunkSize
            );
            $media->setFileSize(filesize($videoPath));//cập nhật dung lượng file (để gg tính đc tổng số phần upload)

            $handle = fopen($videoPath, "rb");//mở file video ở đường dẫn, rb là chế độ đọc (r:read - chỉ đọc, b:binary mode - đọc file nhị phân như video hoặc ảnh)
            $status = false;
            while (!$status && !feof($handle)) {//$status nhận được object video, feof =true là đã đến cuối file
                $chunk = fread($handle, $chunkSize);//đọc tiếp một đoạn dữ liệu từ file
                $status = $media->nextChunk($chunk);//gửi chunk vừa đọc đến api youtube, nextChunk upload đoạn này và trả về false nếu chưa upload hết, video object nếu đã up hết
            }
            fclose($handle);//đóng file khi đọc xong

            $client->setDefer(false);
            // Kiểm tra phản hồi sau khi upload
            if ($status && isset($status['id'])) {
                $videoId = $status['id'];
                // Di chuyển thứ tự bài học nếu cần thiết
                Lesson::where('course_id', $request->course_id)
                ->where('chapter_id', $request->chapter_id)
                ->where('order_number', '>=', $request->order_number)
                ->increment('order_number');
                Lesson::create([
                'name' => $request->name,
                'order_number' => $request->order_number,
                'description' => $request->description,
                'file_id' => $videoId,
                'is_sample' => $request->is_sample,
                'course_id' => $request->course_id,
                'chapter_id' => $request->chapter_id,
                'percent' => $request->percent,
                ]);
                // Lưu vào cơ sở dữ liệu
                // $lesson = new Lesson;
                // $lesson->name = $request->name;
                // $lesson->order_number = $request->order_number;
                // $lesson->description = $request->description;
                // $lesson->file_id = $videoId;
                // $lesson->is_sample = $request->is_sample;
                // $lesson->course_id = $request->course_id;
                // $lesson->chapter_id = $request->chapter_id;
                // $lesson->percent = $request->percent;
                // $lesson->save();

                return redirect()->route('lesson.index')->with('success', 'Thêm video thành công!');
            } else {
                return redirect()->back()->with('error', 'Upload video thất bại! Vui lòng thử lại sau.');
            }
        } catch (\Google_Service_Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi trong quá trình upload video lên YouTube: ' . $e->getMessage());
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        if (Auth::user()->role->name === 'teacher') {
            $courses = Course::where('teacher_id', Auth::id())->get();
        } else {
            $courses = Course::all();
        }
        $this->authorize('view', $lesson);
        return view('admin.lesson.edit', compact('lesson','courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'name'=>'required|string',
            'order_number'=>'required|numeric|min:1',
            'percent' => 'required|numeric|min:1'
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài học !',
            'name.string'=>'Tên bài học là dạng chuỗi !',
            'order_number.required'=>'Bạn chưa nhập thứ tự bài học !',
            'order_number.numeric'=>'Thứ tự bài học là dạng số !',
            'order_number.min'=>'Thứ tự bài học bắt đầu từ 1 !',
        ]);
        try {
            if ($request->hasFile('file'))
            {
                $client = new \Google_Client();
                $client->setClientId(config('services.google.client_id'));
                $client->setClientSecret(config('services.google.client_secret'));
        
                // Lấy access token từ refresh token
                $client->setAccessToken([
                    'access_token' => Http::post('https://oauth2.googleapis.com/token', [
                        'client_id' => config('services.google.client_id'),
                        'client_secret' => config('services.google.client_secret'),
                        'refresh_token' => config('services.google.refresh_token'),
                        'grant_type' => 'refresh_token',
                    ])->json()['access_token']
                ]);
        
                $client->setScopes([
                    'https://www.googleapis.com/auth/youtube.force-ssl', //vừa up video mới vừa thay thế (xoá) video cũ
                    'https://www.googleapis.com/auth/youtube.upload'
                ]);
                $client->setDefer(true);
                $youtube = new \Google_Service_YouTube($client);
                $youtube->videos->delete($lesson->file_id);//xoá video cũ

                $snippet = new \Google_Service_YouTube_VideoSnippet();
                $originalFileName = $request->file('file')->getClientOriginalName();
                $snippet->setTitle($originalFileName);

                $status = new \Google_Service_YouTube_VideoStatus();
                $status->privacyStatus = "unlisted";

                $video = new \Google_Service_YouTube_Video();
                $video->setSnippet($snippet);
                $video->setStatus($status);
                $videoPath = $request->file('file')->getRealPath();
                $chunkSize = 10 * 1024 * 1024;

                $insertRequest = $youtube->videos->insert('status,snippet', $video);
                $media = new \Google\Http\MediaFileUpload(
                    $client,
                    $insertRequest,
                    'video/*',
                    null,
                    true,
                    $chunkSize
                );
                $media->setFileSize(filesize($videoPath));

                $handle = fopen($videoPath, "rb");
                $status = false;
                while (!$status && !feof($handle)) {
                    $chunk = fread($handle, $chunkSize);
                    $status = $media->nextChunk($chunk);
                }
                fclose($handle);

                $client->setDefer(false);
                // Kiểm tra phản hồi sau khi upload
                if ($status && isset($status['id'])) {
                    $videoId = $status['id'];
                    $lesson->file_id = $videoId;
                }
            }
            if ($request->chapter_id != $lesson->chapter_id) {
            // Giảm thứ tự các bài sau trong chương cũ
            Lesson::where('course_id', $lesson->course_id)
                ->where('chapter_id', $lesson->chapter_id)
                ->where('order_number', '>', $lesson->order_number)
                ->decrement('order_number');

            // Tăng thứ tự các bài trong chương mới
            Lesson::where('course_id', $request->course_id)
                ->where('chapter_id', $request->chapter_id)
                ->where('order_number', '>=', $request->order_number)
                ->increment('order_number');

            } elseif ($request->order_number != $lesson->order_number) {
            // Cùng chương nhưng đổi vị trí
                if ($request->order_number > $lesson->order_number) {
                // Nếu chuyển xuống dưới
                Lesson::where('course_id', $lesson->course_id)
                    ->where('chapter_id', $lesson->chapter_id)
                    ->where('order_number', '>', $lesson->order_number)
                    ->where('order_number', '<=', $request->order_number)
                    ->decrement('order_number');
                } else {
                // Nếu chuyển lên trên
                Lesson::where('course_id', $lesson->course_id)
                    ->where('chapter_id', $lesson->chapter_id)
                    ->where('order_number', '>=', $request->order_number)
                    ->where('order_number', '<', $lesson->order_number)
                    ->increment('order_number');
                }
            }
            $lesson->name = $request->name;
            $lesson->order_number = $request->order_number;
            $lesson->description = $request->description;
            $lesson->is_sample = $request->is_sample;
            $lesson->course_id = $request->course_id;
            $lesson->chapter_id = $request->chapter_id;
            $lesson->percent = $request->percent;
            $lesson->save();
            return redirect()->route('lesson.index')->with('success', 'Cập nhật thành công!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $courseId = $lesson->course_id;
        $chapterId = $lesson->chapter_id;
        $orderNumber = $lesson->order_number;
        try {
            $client = new \Google_Client();
            $client->setClientId(config('services.google.client_id'));
            $client->setClientSecret(config('services.google.client_secret'));
    
            // Lấy access token từ refresh token
            $client->setAccessToken([
                'access_token' => Http::post('https://oauth2.googleapis.com/token', [
                    'client_id' => config('services.google.client_id'),
                    'client_secret' => config('services.google.client_secret'),
                    'refresh_token' => config('services.google.refresh_token'),
                    'grant_type' => 'refresh_token',
                ])->json()['access_token']
            ]);
    
            $client->setScopes(['https://www.googleapis.com/auth/youtube.force-ssl']);
            $youtube = new \Google_Service_YouTube($client);
    
            // Gọi API xoá video
            $youtube->videos->delete($lesson->file_id);
            $lesson->delete();
            Lesson::where('course_id', $courseId)
            ->where('chapter_id', $chapterId)
            ->where('order_number', '>', $orderNumber)
            ->decrement('order_number');
    
            return redirect()->back()->with('success', 'Xóa bài học thành công!');
        } catch (\Google_Service_Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi xóa video: ' . $e->getMessage());
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
}
