<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model
{
    use HasFactory;
    protected $table = 'lesson_progress';
    protected $fillable = ['student_id', 'lesson_id', 'completed_at'];
    protected $casts = ['completed_at' => 'datetime'];
}
