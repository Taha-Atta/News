<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){


        $posts = Post::active()->with('images')->latest()->paginate(9);

        $most_views =Post::active()->OrderBy('num_of_views','desc')->limit(4)->get();

        $old_news =  Post::active()->oldest()->limit(4)->get();
        // $old_news =  Post::orderBy('created_at', 'asc')->limit(3)->get();

       $great_posts_commemt = Post::active()->withCount('comments')->orderby('comments_count','desc')->take(4)->get();

       $categories = Category::all();
        $categories_with_posts = $categories->map(function($category){
            $category->posts = $category->posts()->limit(4)->get();
            return $category;
        });


    //    return  $categories_with_posts;


        return view('frontend.index',get_defined_vars());

    }
}
