<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Answer;
use App\Models\StudentExam;
use App\Models\StudentAnswer;
use App\Models\StudentTempAnswer;
use Str;
use Illuminate\Http\Request;

class StuExamController extends Controller
{
    public function exam(Exam $exam){
        $student = auth('stu')->user();

        $isEnrolled = $student->enrolledCourses()
            ->where('course_id', $exam->chapter->course->id)
            ->exists();

        if (!$isEnrolled && !$exam->is_sample) {
            return redirect()->back()->with('error', 'Bạn chưa đăng ký khóa học');
        }

        $totalQuestions = $exam->question_count;
        $attempts = StudentExam::where('student_id', $student->id)
        ->where('exam_id', $exam->id)
        ->orderBy('start_time', 'asc')
        ->get();
        $lastAttempt = $attempts->last();
        $highestScore = $attempts->max('score');
        return view('frontend.exam', compact('attempts', 'exam', 'totalQuestions','highestScore','lastAttempt'));
    }

    public function exam_detail($exam_id)
    {
        $student = auth('stu')->user();
        $exam = Exam::with(['course', 'chapter'])->findOrFail($exam_id);

        $isEnrolled = $student->enrolledCourses()
            ->where('course_id', $exam->chapter->course->id)
            ->exists();

        if (!$isEnrolled && !$exam->is_sample) {
            return redirect()->back()->with('error', 'Bạn chưa đăng ký khóa học');
        }

        // Kiểm tra lần thi trước (nếu có đang làm dở)
        $studentExam = StudentExam::where('student_id', $student->id)
            ->where('exam_id', $exam->id)
            ->where('status', 'doing')
            ->latest('id')
            ->first();

        if (!$studentExam || now()->greaterThan($studentExam->end_time)) {
            // Kiểm tra số lần thi
            $attemptCount = StudentExam::where('student_id', $student->id)
                ->where('exam_id', $exam->id)
                ->count();

            if ($attemptCount >= $exam->max_attempts) {
                return redirect()->back()->with('error', 'Bạn đã vượt quá số lần làm bài.');
            }

            // Random câu hỏi theo chương và độ khó
            $easyQuestions = $exam->chapter->questions()
                ->where('difficulty', 'easy')
                ->inRandomOrder()
                ->take($exam->easy_count)
                ->get();

            $hardQuestions = $exam->chapter->questions()
                ->where('difficulty', 'hard')
                ->inRandomOrder()
                ->take($exam->hard_count)
                ->get();

            $selectedQuestions = $easyQuestions->merge($hardQuestions)->shuffle();

            // Tạo bản ghi StudentExam
            $studentExam = StudentExam::create([
                'student_id' => $student->id,
                'exam_id'    => $exam->id,
                'start_time' => now(),
                'end_time'   => now()->addMinutes($exam->time),
                'status'     => 'doing',
            ]);

            // Lưu lại câu hỏi được random vào bảng pivot
            foreach ($selectedQuestions as $question) {
                $studentExam->questions()->attach($question->id);
            }
        }

        $savedAnswers = StudentTempAnswer::where('student_exam_id', $studentExam->id)//[question_id => answer_ids]
                        ->get()
                        ->pluck('answer_ids', 'question_id');

        $timeleft = max(0, $studentExam->end_time->diffInSeconds(now()));

        $questions = $studentExam->questions()->paginate(3);
        $allQuestions = $studentExam->questions;
        $currentPage = $questions->currentPage();
        $timeLimit = $exam->time;

        return view('frontend.exam_detail', compact(
            'exam', 'studentExam', 'timeLimit', 'questions', 'currentPage', 'allQuestions', 'timeleft','savedAnswers'
        ));
    }

    public function submitAnswers(Request $request)
    {
        $student = auth('stu')->user();
        $examId = $request->input('exam_id');

        $studentExam = StudentExam::where('student_id', $student->id)
            ->where('exam_id', $examId)
            ->where('status', 'doing')
            ->latest('id')
            ->first();

        if (!$studentExam) {
            return redirect()->back()->with('error', 'Không tìm thấy bài thi đang làm.');
        }

        $rawAnswers = $request->input('answers_data');
        $answers = json_decode($rawAnswers, true);
        
        $correctCount = 0;
        $totalQuestions = $studentExam->questions()->count(); // Đếm từ bảng pivot

        if (is_array($answers)) {
            foreach ($answers as $questionId => $submittedAnswers) {
                $submittedAnswers = (array) $submittedAnswers;

                // Lưu từng câu trả lời
                foreach ($submittedAnswers as $answerId) {
                    StudentAnswer::create([
                        'student_exam_id' => $studentExam->id,
                        'question_id'     => $questionId,
                        'answer_id'       => $answerId,
                    ]);
                }

                // Lấy đáp án đúng từ DB
                $correctAnswers = Answer::where('question_id', $questionId)
                    ->where('is_correct', true)
                    ->pluck('id')
                    ->toArray();

                // So sánh nếu học viên chọn đúng tất cả đáp án
                sort($submittedAnswers);
                sort($correctAnswers);

                if ($submittedAnswers == $correctAnswers) {
                    $correctCount++;
                }
            }
        }

        $finalScore = round(($correctCount / max(1, $totalQuestions)) * 10, 2);

        // Lưu kết quả
        $studentExam->update([
            'score' => $finalScore,
            'status' => 'done',
            'submitted_at' => now(),
        ]);

        return redirect()->route('exam', $examId)->with('success', 'Bạn đã nộp bài thành công! Điểm: ' . $finalScore);
    }

    public function save(Request $request)
    {
        $request->validate([
            'student_exam_id' => 'required|integer|exists:student_exams,id',
            'answers' => 'required|array'
        ]);

        $studentExamId = $request->input('student_exam_id');
        $answers = $request->input('answers'); // dạng: [question_id => [answer_ids]]

        foreach ($answers as $questionId => $answerIds) {
            StudentTempAnswer::updateOrCreate(
                [
                    'student_exam_id' => $studentExamId,
                    'question_id' => $questionId
                ],
                [
                    'answer_ids' => $answerIds
                ]
            );
        }

        return response()->json(['status' => 'success']);
    }

    public function review(StudentExam $attempt){
        $student = auth('stu')->user();

        if ($attempt->student_id !== $student->id || $attempt->submitted_at === null) {
            abort(403, 'Bạn không có quyền !');
        }
        $exam = $attempt->exam;

        $questions = $attempt->questions()
        ->with([
            'answers',
            'studentAnswers' => function ($query) use ($attempt) {
                $query->where('student_exam_id', $attempt->id); //lấy tất cả câu trả lời của học viên
            }
        ])
        ->paginate(3);

        return view('frontend.exam_review', compact('attempt', 'exam', 'questions'));
    }

    public function overview_result(){
        $student = auth('stu')->user();
        $courses = $student->enrolledCourses()->get();

        $examScores = \DB::table('student_exams')
            ->join('exams', 'student_exams.exam_id', '=', 'exams.id')
            ->join('chapters', 'exams.chapter_id', '=', 'chapters.id')
            ->join('courses', 'chapters.course_id', '=', 'courses.id')
            ->where('student_exams.student_id', $student->id)
            ->select(
                'courses.id as course_id',
                'exams.id as exam_id',
                \DB::raw('MAX(student_exams.score) as max_score')
            )
            ->groupBy('courses.id', 'exams.id')
            ->get();

        $courseScores = [];
        foreach ($examScores as $score) {
            $courseScores[$score->course_id] = ($courseScores[$score->course_id] ?? 0) + $score->max_score;
        }

        return view('frontend.overview_result', compact('courses', 'courseScores'));
    }
    public function overview_exam($courseId){
        $student = auth('stu')->user();

        $course = Course::with(['chapters.exams' => function ($query) use ($student) {
            $query->with(['studentExams' => function ($q) use ($student) {
                $q->where('student_id', $student->id);
            }]);
        }])->findOrFail($courseId);

        return view('frontend.overview_exam', compact('course'));
    }
}
