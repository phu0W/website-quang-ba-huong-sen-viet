<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTempAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['student_exam_id', 'question_id', 'answer_ids'];
    protected $casts = [
        'answer_ids' => 'array',
    ];
}
