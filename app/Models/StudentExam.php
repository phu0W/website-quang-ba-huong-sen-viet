<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    use HasFactory;
    protected $table = 'student_exams';
    protected $fillable = [
        'student_id',
        'exam_id',
        'start_time',
        'end_time',
        'submitted_at',
        'status',
        'score',
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'submitted_at' => 'datetime',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'student_exam_question')->withTimestamps();
    }

}
