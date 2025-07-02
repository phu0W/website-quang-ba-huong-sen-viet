<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResetToken extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    protected $fillable = ['email', 'token'];
    public function student(){
        return $this->hasOne(Student::class, 'email', 'email');
    }
}

