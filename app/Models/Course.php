<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','price','image','is_featured','subject_id','teacher_id'];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    // public function lessons()
    // {
    //     return $this->hasMany(Lesson::class);
    // }
    // public function exams()
    // {
    //     return $this->hasMany(Exam::class);
    // }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
