<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_temp_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_exam_id');
            $table->foreign('student_exam_id')->references('id')->on('student_exams');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->json('answer_ids')->nullable();
            $table->unique(['student_exam_id', 'question_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_temp_answers');
    }
};
