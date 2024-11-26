<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,Sluggable;

    protected $guarded = [];

    public function posts(){

        return $this->hasMany(Post::class,'category_id');
    }


    public function scopeActive($query)
    {
        $query->where('status',1);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function status(){

        return $this->status == 1 ? 'Active':'Not Active';
    }
}
