<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonProgress;
use DB;

use Illuminate\Http\Request;

class StuLessonController extends Controller
{
    

    public function lesson(Course $course, Lesson $lesson)
    {
        $student = auth('stu')->user();

        // Kiểm tra học viên đã đăng ký khóa học chưa
        $isEnrolled = $student->enrolledCourses()
                            ->where('course_id', $course->id)
                            ->exists();
        $completedLessonIds = LessonProgress::where('student_id', $student->id)
                            ->whereNotNull('completed_at')
                            ->pluck('lesson_id')
                            ->toArray();

        // Lấy chương, bài học, bài kiểm tra
        $chapters = $course->chapters()
                        ->with(['lessons', 'exams'])
                        ->orderBy('order_number')
                        ->get();

        // Gom từng chương với items (lessons + exams)
        $navigationChapters = $chapters->map(function ($chapter) {//map function xử lý phức tạp hơn 1 dòng
            $lessons = $chapter->lessons->map(fn($l) => [//map => gán luôn 1 dòng
                'type' => 'lesson',
                'id' => $l->id,
                'model' => $l,
                'order_number' => $l->order_number,
            ]);

            $exams = $chapter->exams->map(fn($e) => [
                'type' => 'exam',
                'id' => $e->id,
                'model' => $e,
                'order_number' => $e->order_number,
            ]);

            return [
                'id' => $chapter->id,
                'title' => $chapter->title,
                'items' => $lessons->merge($exams)->sortBy('order_number')->values(), //dùng value để reset key về 0,1,2.. tránh lỗi khi duyệt vòng lặp
            ];
        });

        // Gom tất cả các item vào một danh sách phẳng để xác định vị trí hiện tại
        $flatItems = $navigationChapters->flatMap(fn($c) => $c['items'])->values();

        $currentIndex = $flatItems->search(fn($item) => $item['type'] === 'lesson' && $item['id'] === $lesson->id);
        $previousItem = $flatItems[$currentIndex - 1] ?? null;//null nếu là bài đầu tiên

        // Kiểm tra đã hoàn thành bài trước chưa (nếu là bài học)
        $hasCompletedPrev = true;
        if ($previousItem && $previousItem['type'] === 'lesson') {//nếu có bài trước/bài trước là bài học
            $hasCompletedPrev = LessonProgress::where('student_id', $student->id)
                ->where('lesson_id', $previousItem['id'])
                ->whereNotNull('completed_at')
                ->exists();
        }

        // Kiểm tra quyền xem
        $canView = $lesson->is_sample || $isEnrolled;
        
        if ($canView) {
            if ($currentIndex === 0 || $hasCompletedPrev) {//bài đầu không cần check tiến độ bài trước
                return view('frontend.video', [
                    'lesson' => $lesson,
                    'course' => $course,
                    'navigationChapters' => $navigationChapters,
                    'currentLessonId' => $lesson->id,
                    'isEnrolled' => $isEnrolled,
                    'completedLessonIds' => $completedLessonIds,
                ]);
            } else {
                return redirect()->back()->with('error', 'Bạn chưa hoàn thành bài học trước!');
            }
        }

        return redirect()->back()->with('error', 'Bạn chưa đăng ký khóa học!');
    }


    public function updateProgress(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'student_id' => 'required|exists:students,id',
        ]);
    
        LessonProgress::updateOrCreate(
        [
            'student_id' => $request->student_id,
            'lesson_id' => $request->lesson_id,
        ],
        [
            'completed_at' => now(),
        ]);
        return response()->json(['status' => 'ok']);
    }

    public function my_course(){
        $student = auth('stu')->user();
        $courses = $student->enrolledCourses()->get();
        return view('frontend.my_course', compact('courses'));
    }
}
