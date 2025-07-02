<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\Slider;
use App\Models\Post;
use App\Models\LessonProgress;
use App\Models\Feedback;
use Str;
use DB;
use Mail;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $subjects = Subject::all();
        $sliders = Slider::take(3)->orderBy('order_number', 'asc')->get();
        $featuredCourses = Course::where('is_featured', true)->get();
        $featured = Post::where('is_featured', 1)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
        $latest = Post::where('is_featured', 0)
                    ->orderBy('created_at', 'desc')
                    ->take(4)
                    ->get();
        return view('frontend.index', compact('subjects','featuredCourses','sliders','featured','latest'));
    }
    public function course_list($subject_id){
        $subject = Subject::with('courses')->findOrFail($subject_id);
        return view('frontend.course', [
            'subject' => $subject,
            'courses' => $subject->courses
        ]);
    }
    

    public function course_detail($course_id)
    {
        $course = Course::with(['chapters.lessons', 'chapters.exams'])->findOrFail($course_id);

        $ratingAvg = Feedback::where('course_id', $course->id)->avg('rating');

        $isEnrolled = 0;
        $stuRating = 0;
        $feedBack = null;
        $isEnrolled = 0;
        $completedLessonIds = [];

        if (auth('stu')->check()) {
            $student = auth('stu')->user();
            $isEnrolled = $student->enrolledCourses()->where('course_id', $course->id)->exists();
            $feedBack = Feedback::where('course_id', $course->id)->where('student_id', $student->id)->first();
            if ($feedBack) {
                $stuRating = $feedBack->rating;
            }
            $isEnrolled = $student->enrolledCourses()
                        ->where('course_id', $course->id)
                        ->exists();
            $completedLessonIds = LessonProgress::where('student_id', $student->id)
                            ->whereNotNull('completed_at')
                            ->pluck('lesson_id')
                            ->toArray();
        }

        // Chuẩn bị danh sách chương -> bài học & bài kiểm tra
        $chapters = $course->chapters->map(function ($chapter) {
            $lessons = $chapter->lessons->map(function ($lesson) {
                return [
                    'type' => 'lesson',
                    'id' => $lesson->id,
                    'name' => $lesson->name,
                    'order_number' => $lesson->order_number,
                    'is_sample' => $lesson->is_sample,
                ];
            });

            $exams = $chapter->exams->map(function ($exam) {
                return [
                    'type' => 'exam',
                    'id' => $exam->id,
                    'name' => $exam->name,
                    'order_number' => $exam->order_number,
                ];
            });
            $items = $lessons->merge($exams)->sortBy('order_number')->values();

            return [
                'id' => $chapter->id,
                'title' => $chapter->title,
                'items' => $items,
            ];
        });

        return view('frontend.course_detail', compact(
            'course',
            'chapters',
            'isEnrolled',
            'stuRating',
            'ratingAvg',
            'feedBack',
            'isEnrolled',
            'completedLessonIds'
        ));
    }


    public function introduction(){
        return view('frontend.introduction');
    }
    public function new(){
        $post = Post::all();
        $post1 = Post::where('is_featured', 1)->orderBy('created_at', 'desc')->first();
        $post2 = Post::where('is_featured', 1)->orderBy('created_at', 'desc')->take(2)->get();
        return view('frontend.new', compact('post','post1','post2'));
    }
    public function new_detail($new_id){
        $post = Post::find($new_id);
        $list = Post::where('is_featured', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('frontend.new_detail', compact('post','list'));
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function post_contact(Request $req){
        $req->validate([
            'name' => 'required|',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ]);
        $data = [
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'message' => $req->message
        ];

        Mail::to('daothibinh2k3@gmail.com')->send(new ContactFormMail($data));
        return redirect()->back()->with('success', 'Bạn gửi thông tin liên hệ thành công !');
    }
}
