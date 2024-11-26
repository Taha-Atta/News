<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewSubsciber extends Model
{
    use HasFactory;

    protected $fillable = ['email'];
}
