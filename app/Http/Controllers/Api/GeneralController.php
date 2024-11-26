<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\Collection;

use function App\Http\ApiResponse;
use function App\Http\test;

class GeneralController extends Controller
{
    public function posts()
    {


        $posts = Post::query()->with(['user', 'category', 'admin', 'images'])->activeUser()->activeCategory()->active();
        if (!$posts) {
            return ApiResponse(404, 'posts not found');
        }
        if( request()->query('keyword')){
            $posts->where('title','LIKE','%'. request()->query('keyword').'%');
        }
        $all_posts             = clone $posts->latest()->paginate(4);
        $latest_posts          = $this->LatestPosts(clone $posts);
        $oldest_posts          = clone $posts->oldest()->take(3)->get();
        $most_views            = clone $posts->orderBy('num_of_views', 'desc')->take(3)->get();
        $poupler_posts         = clone $posts->withCount('comments')->orderBy('comments_count', 'desc')->get();
        $categories_with_posts = $this->CategoryWithPosts();

        $data = [
            'all_posts'              => (new PostCollection($all_posts))->response()->getData(true),
            'latest_posts'           => new PostCollection($latest_posts),
            'oldest_posts'           => new PostCollection($oldest_posts),
            'most_views'             => new PostCollection($most_views),
            'poupler_posts'          => new PostCollection($poupler_posts),
            'categories_with_posts'  => new CategoryCollection($categories_with_posts),
        ];
        return ApiResponse(200, 'this data', $data);
    }

    public function LatestPosts($posts)
    {
        $latest_posts = $posts->latest()->take(4)->get();
        if (!$latest_posts) {
            return ApiResponse(404, 'posts not found');
        }
        return $latest_posts;
    }

    public function CategoryWithPosts()
    {
        $categories = Category::active()->get();
        if (!$categories) {
            return ApiResponse(404, 'categories not found');
        }
        $categories_with_posts = $categories->map(function ($category) {
            $category->posts =  $category->posts()->active()->limit(4)->get();
            return $category;
        });
        return  $categories_with_posts;
        if (!$categories_with_posts) {
            return ApiResponse(404, 'categories not found');
        }
    }


    public function showPost($slug)
    {
        $post = Post::with(['user', 'category', 'admin', 'images'])->activeUser()->activeCategory()->whereSlug($slug)->first();
        if (!$post) {
            return ApiResponse(404, 'post not found');
        }
        return ApiResponse(200, 'post found', $post);
    }

    public function showPostComment($slug)
    {
        $post = Post::activeUser()->activeCategory()->active()->whereSlug($slug)->first();
        if (!$post) {
            return ApiResponse(404, 'post not found');
        }
        $comments = $post->comments;
        if (!$comments) {
            return ApiResponse(404, 'comments not found');
        }

        return ApiResponse(200, 'comments found', new CommentCollection($comments));
    }



    public function shearchPosts(Request $request)
    {
        $keyword = $request->keyword;
        $posts = Post::active()->where('title','LIKE','%'.$keyword.'%')
        ->orwhere('description','LIKE','%'.$keyword.'%')
        ->paginate(4);
        if(!$posts){

            return ApiResponse(404,'there are not posts ');
        }
        return ApiResponse(200,'this posts',( new PostCollection($posts))->response()->getData(true));
    }
}
