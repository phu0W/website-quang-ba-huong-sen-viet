<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['name','order_number','description','file_id','percent','is_sample','course_id', 'chapter_id'];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
