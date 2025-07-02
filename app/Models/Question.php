<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question_text','question_type','difficulty','chapter_id'];
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}
