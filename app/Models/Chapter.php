<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'title',
        'order_number',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
