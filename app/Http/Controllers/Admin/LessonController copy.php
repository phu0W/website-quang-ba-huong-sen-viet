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
use Google\Service\YouTube;

class LessonController extends Controller
{
    private function token(){
        $client_id=\Config('services.google.client_id');
        $client_secret=\Config('services.google.client_secret');
        $refresh_token=\Config('services.google.refresh_token');
        $response=Http::post('https://oauth2.googleapis.com/token',[
            'client_id'=>$client_id,
            'client_secret'=>$client_secret,
            'refresh_token'=>$refresh_token,
            'grant_type'=>'refresh_token',
        ]);

        $accessToken=json_decode((string)$response->getBody(),true)['access_token'];
        return $accessToken;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stt=1;
        if (Auth::user()->role->name === 'teacher') {
            $courseIds = Course::where('teacher_id', Auth::id())->pluck('id');
            $lessons = Lesson::whereIn('course_id', $courseIds)
            ->orderBy('course_id')
            ->orderBy('order_number', 'asc')
            ->get();
        } else {
            $lessons = Lesson::with('course')
                ->orderBy('course_id')         // Nhóm theo khóa học
                ->orderBy('order_number', 'asc') // Thứ tự bài học trong từng khóa
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'order_number'=>'required|numeric|min:1',
            'course_id'=>'required',
            'file'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên bài học !',
            'name.string'=>'Tên bài học là dạng chuỗi !',
            'order_number.required'=>'Bạn chưa nhập thứ tự bài học !',
            'order_number.numeric'=>'Thứ tự bài học là dạng số !',
            'order_number.min'=>'Thứ tự bài học bắt đầu từ 1 !',
            'course_id.required'=>'Chưa chọn khóa học !',
        ]);
        $accessToken = $this->token();
        $name = $request->file->getClientOriginalName();
        $mimeType = $request->file->getMimeType();

        $response = Http::withToken($accessToken)
            ->withHeaders([
                'X-Upload-Content-Type' => $mimeType,
                'X-Upload-Content-Length' => $request->file->getSize(),
                'Content-Type' => 'application/json',
            ])
            ->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=resumable', [
                'name' => $name,
                'parents' => [\Config('services.google.folder_id')]
            ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Không thể tạo phiên upload.');
        }

        $uploadUrl = $response->header('Location'); // Lấy URL để upload dữ liệu file

        $fileContent = file_get_contents($request->file->getRealPath());

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Length' => strlen($fileContent),
            'Content-Type' => $mimeType,
        ])->withBody($fileContent, $mimeType)
            ->put($uploadUrl);

        if ($response->successful()) {
            $fileData = json_decode($response->body(), true);
            $fileId = $fileData['id'];

            Http::withToken($accessToken)->post("https://www.googleapis.com/drive/v3/files/{$fileId}/permissions", [
                'role' => 'reader',
                'type' => 'anyone'
            ]);

            // Đẩy thứ tự bài học phía sau nếu bị trùng (theo course_id)
            Lesson::where('course_id', $request->course_id)
                ->where('order_number', '>=', $request->order_number)
                ->increment('order_number');

            //Lưu vào database
            $lesson = new Lesson;
            $lesson->name = $request->name;
            $lesson->order_number = $request->order_number;
            $lesson->description = $request->description;
            $lesson->file_id = $fileId;
            $lesson->is_sample = $request->is_sample;
            $lesson->course_id = $request->course_id;
            $lesson->save();

            return redirect()->route('lesson.index')->with('success', 'Thêm thành công!');
        } else {
            return redirect()->back()->with('error', 'Thêm thất bại!');
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
                $accessToken = $this->token();
                $response = Http::withToken($accessToken)->delete("https://www.googleapis.com/drive/v3/files/$lesson->file_id");

                $name = $request->file->getClientOriginalName();
                $mimeType = $request->file->getMimeType();

                $response = Http::withToken($accessToken)->withHeaders([
                    'X-Upload-Content-Type' => $mimeType,
                    'X-Upload-Content-Length' => $request->file->getSize(),
                    'Content-Type' => 'application/json',
                ])->post('https://www.googleapis.com/upload/drive/v3/files?uploadType=resumable', [
                    'name' => $name,
                    'parents' => [\Config('services.google.folder_id')]
                ]);
                if ($response->failed()) {
                    return redirect()->back()->with('error', 'Không thể tạo phiên upload.');
                }
            
                $uploadUrl = $response->header('Location'); // Lấy URL để upload dữ liệu file
                $fileContent = file_get_contents($request->file->getRealPath());
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Length' => strlen($fileContent),
                    'Content-Type' => $mimeType,
                ])->withBody($fileContent, $mimeType)->put($uploadUrl);
                if ($response->successful()) {
                    $fileData = json_decode($response->body(), true);
                    $fileId = $fileData['id'];
                    $lesson->file_id = $fileId;
                    Http::withToken($accessToken)->post("https://www.googleapis.com/drive/v3/files/{$fileId}/permissions", [
                        'role' => 'reader',
                        'type' => 'anyone'
                    ]);
                }
            }
            $lesson->name = $request->name;
            $lesson->order_number = $request->order_number;
            $lesson->description = $request->description;
            $lesson->is_sample = $request->is_sample;
            $lesson->course_id = $request->course_id;
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
        $this->authorize('delete', $lesson);
        $accessToken = $this->token(); // Lấy Access Token từ Google OAuth

        $response = Http::withToken($accessToken)
            ->delete("https://www.googleapis.com/drive/v3/files/$lesson->file_id");

        if ($response->successful()) {
            $lesson->delete();
            return redirect()->back()->with('success', 'Xóa thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa thất bại!');
        }
    }
    public function watch($id)
    {
        $lesson = Lesson::findOrFail($id);
        $videoUrl = "https://drive.google.com/file/d/$lesson->file_id/preview";
        return view('admin.lesson.show', compact('videoUrl'));
    }
}
