<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infor extends Model
{
    use HasFactory;
    protected $fillable = ['phone1','phone2','fb','logo','email','address1','address2','content'];
}
