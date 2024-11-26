<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoreisController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
            $category = Category::active()->whereSlug($slug)->first();
            // return $category;
            $posts =  $category->posts()->paginate(9);
            // return $posts;
            return view('frontend.categoryPosts',compact('posts','category'));
        }
}
