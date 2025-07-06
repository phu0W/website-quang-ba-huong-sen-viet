<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','is_sample','pass_score','max_attempts','time','question_count','chapter_id','order_number','easy_count','hard_count'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function studentExams()
    {
        return $this->hasMany(StudentExam::class);
    }

}
