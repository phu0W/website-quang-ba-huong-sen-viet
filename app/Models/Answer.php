<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = ['answer_text','is_correct','question_id'];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
