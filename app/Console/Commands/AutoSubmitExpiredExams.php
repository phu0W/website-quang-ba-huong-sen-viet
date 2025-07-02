<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudentExam;
use App\Models\StudentAnswer;
use App\Models\StudentTempAnswer;
use App\Models\Question;
use Carbon\Carbon;
use DB;

class AutoSubmitExpiredExams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:auto-submit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tự động nộp bài thi nếu đã hết thời gian';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $expiredExams = StudentExam::where('status', 'doing')
            ->where('end_time', '<', $now)
            ->get();
        foreach ($expiredExams as $exam) {
            DB::transaction(function () use ($exam) {
                $tempAnswers = StudentTempAnswer::where('student_exam_id', $exam->id)->get();
                $totalQuestions = $exam->exam->question_count;
                // Lưu vào bảng chính thức
                foreach ($tempAnswers as $temp) {
                    foreach ($temp->answer_ids as $answerId) {
                        StudentAnswer::create([
                            'student_exam_id' => $exam->id,
                            'question_id' => $temp->question_id,
                            'answer_id' => $answerId
                        ]);
                    }
                }

                // Tính điểm
                $correct = $this->calculateCorrect($exam->id);
                $score = round(($correct / max(1, $totalQuestions)) * 10, 2);

                // Cập nhật trạng thái bài thi
                $exam->update([
                    'status' => 'done',
                    'submitted_at' => now(),
                    'score' => $score
                ]);

                // Xoá câu trả lời tạm
                StudentTempAnswer::where('student_exam_id', $exam->id)->delete();
            });

            $this->info("Đã tự động nộp bài thi ID {$exam->id}");
        }

        return Command::SUCCESS;
    }

    private function calculateCorrect($studentExamId)
    {
        $studentAnswers = StudentAnswer::where('student_exam_id', $studentExamId)->get()->groupBy('question_id');
        $questionIds = $studentAnswers->keys();

        $score = 0;

        foreach ($questionIds as $questionId) {
            $correctAnswers = Question::find($questionId)->answers()->where('is_correct', true)->pluck('id')->sort()->values();
            $chosenAnswers = collect($studentAnswers[$questionId])->pluck('answer_id')->sort()->values();

            if ($correctAnswers->toArray() === $chosenAnswers->toArray()) {
                $score++;
            }
        }

        return $score;
    }

}
