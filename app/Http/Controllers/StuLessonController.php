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

        $navigationChapters = $chapters->map(function ($chapter) {
            // Danh sách bài học
            $lessons = $chapter->lessons->map(fn($l) => [
                'type' => 'lesson',
                'id' => $l->id,
                'model' => $l,
                'order_number' => $l->order_number,
            ])->sortBy('order_number')->values();

            // Danh sách bài kiểm tra
            $exams = $chapter->exams->map(fn($e) => [
                'type' => 'exam',
                'id' => $e->id,
                'model' => $e,
                'order_number' => $e->order_number,
            ])->sortBy('order_number')->values();

            return [
                'id' => $chapter->id,
                'title' => $chapter->title,
                'items' => $lessons->merge($exams),
            ];
        });


        // Gom tất cả các item vào một danh sách phẳng để xác định vị trí hiện tại
        $flatItems = $navigationChapters->flatMap(fn($c) => $c['items'])->values();

        $currentIndex = $flatItems->search(fn($item) => $item['type'] === 'lesson' && $item['id'] === $lesson->id);
        $previousItem = $flatItems
            ->slice(0, $currentIndex)        // lấy các phần tử trước vị trí hiện tại
            ->reverse()                      // đảo ngược để duyệt từ gần nhất về đầu
            ->first(fn($item) => $item['type'] === 'lesson');
        //dd($previousItem);
        $nextLesson = null;
        for ($i = $currentIndex + 1; $i < count($flatItems); $i++) {
            if ($flatItems[$i]['type'] === 'lesson') {
                $nextLesson = $flatItems[$i]['model'];
                break;
            }
        }
        $nextLessonUrl = $nextLesson ? route('lesson', ['course' => $course->id, 'lesson' => $nextLesson->id]) : null;
        // Kiểm tra đã hoàn thành bài trước chưa (nếu là bài học)
        $hasCompletedPrev = true;
        if ($previousItem && $previousItem['type'] === 'lesson') {
            $hasCompletedPrev = LessonProgress::where('student_id', $student->id)
                ->where('lesson_id', $previousItem['id'])
                ->whereNotNull('completed_at')
                ->exists();
        }
        $isCompletedCurrent = LessonProgress::where('student_id', $student->id)
            ->where('lesson_id', $lesson->id)
            ->whereNotNull('completed_at')
            ->exists();

        // Kiểm tra quyền xem
        //$canView = $lesson->is_sample || $isEnrolled;
        
        if ($isEnrolled) {
            if ($currentIndex === 0 || $hasCompletedPrev) {
                return view('frontend.video', [
                    'lesson' => $lesson,
                    'course' => $course,
                    'navigationChapters' => $navigationChapters,
                    'currentLessonId' => $lesson->id,
                    'isEnrolled' => $isEnrolled,
                    'completedLessonIds' => $completedLessonIds,
                    'nextLessonUrl' => $nextLessonUrl,
                    'isCompletedCurrent' => $isCompletedCurrent,
                ]);
            } else {
                return redirect()->back()->with('error', 'Bạn chưa hoàn thành bài học trước!');
            }
        }

        if ($lesson->is_sample) {
            return view('frontend.video', [
                'lesson' => $lesson,
                'course' => $course,
                'navigationChapters' => $navigationChapters,
                'currentLessonId' => $lesson->id,
                'isEnrolled' => $isEnrolled,
                'completedLessonIds' => $completedLessonIds,
                'nextLessonUrl' => $nextLessonUrl,
                'isCompletedCurrent' => $isCompletedCurrent,
            ]);
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