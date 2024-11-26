<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelateNewsSite extends Model
{
    use HasFactory;
    protected $table = 'related_site';
    protected $fillable = ['name','url'];
}
