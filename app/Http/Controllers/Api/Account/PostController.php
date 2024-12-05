<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\Post;
use App\Models\Comment;
use App\utils\ImageManger;
use Illuminate\Http\Request;

use function App\Http\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\PostCollection;
use App\Http\Resources\CommentResource;
use App\Http\Requests\Frontend\PostRequest;
use Illuminate\Support\Facades\RateLimiter;
use App\Notifications\NewCommentNotification;

class PostController extends Controller
{
    public function getPosts()
    {
        // $user = request()->user();
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return ApiResponse(404, 'user not found');
        }

        $posts =  $user->posts()->active()->get();
        if ($posts->count() < 1) {
            return ApiResponse(404, 'posts not found');
        }
        return ApiResponse(200, 'posts found', new PostCollection($posts));
    }

    public function storePosts(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            // $user_id = auth()->user()->id;

            // $request->merge([
            //     'user_id'=>$user_id
            // ]);
            $post = auth()->user()->posts()->create($request->except('images'));
            ImageManger::uploadImage($request, $post);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("post  is not created " . $e->getMessage());
            return ApiResponse(404, 'Bad Request');
        }
        return ApiResponse(201, 'post creted successuly');
    }

    public function deletePost($post_id)
    {
        $user = auth()->user();
        $post = $user->posts()->where('id', $post_id)->first();
        if (!$post) {
            return ApiResponse(404, 'post not found');
        }
        ImageManger::deleteImage($post);
        $post->delete();
        return ApiResponse(201, 'post delete successfuly');
    }

    public function getPostComments($post_id)
    {
        $user = auth()->user();
        $post = $user->posts()->where('id', $post_id)->first();
        if (!$post) {
            return ApiResponse(404, 'post not found');
        }

        if ($post->comments->count() > 0) {
            return ApiResponse(200, 'comments found', CommentResource::collection($post->comments));
        }
        return ApiResponse(404, 'comments not found');
    }

    public function updatePost(PostRequest $request, $post_id)
    {

        $request->validated();
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $post = $user->posts()->where('id', $post_id)->first();
            if ($request->hasFile('images')) {
                ImageManger::deleteImage($post);
                ImageManger::uploadImage($request, $post);
            }
            $post->update($request->except('images'));
            DB::commit();
            return ApiResponse(201, 'post update successuly');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("post  is not updated " . $e->getMessage());
            return ApiResponse(404, 'Bad Request');
        }
    }


    public function storePostComment(CommentRequest $request)
    {
        $request->validated();

        $key = 'storePostComment' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 2)) {
            $time = RateLimiter::availableIn($key);
            return ApiResponse(429, 'try agian after ' . $time . ' seconds');
        }
        RateLimiter::hit($key, 60);
        
        $comment = Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            "comment" => $request->comment,
            "ip_address" => $request->ip(),
        ]);
        if (!$comment) {
            return ApiResponse(404, 'comment faild');
        }
        $post = Post::where('id', $request->post_id)->first();

        // if ($post->user->id !== auth()->user()->id) {
        // }
        // $post->user->notify(new NewCommentNotification($comment, $post));

        $remain = RateLimiter::remaining($key, 2);

        return ApiResponse(201, 'comment store successfuly', ['remain' => $remain]);
    }
}
