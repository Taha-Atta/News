<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Notifications\NewCommentNotification;

class PostController extends Controller
{
    public function show($slug)
    {
        $mainPost = Post::active()->with(['comments' => function ($query) {
            $query->latest()->limit(3);
        }])->whereSlug($slug)->first();

        if(!$mainPost){
            return abort(404);
        }
        $category = $mainPost->category;

        // return $category;

        $posts_bleng_to_category = $category->posts()->select('id', 'slug', 'title')->limit(5)->get();



        $mainPost->increment('num_of_views');

        return view('frontend.showPost', compact('mainPost', 'posts_bleng_to_category'));
    }




    public function getAllcomment($slug)
    {

        $post = Post::active()->whereSlug($slug)->first();
        $comments = $post->comments()->with('user')->get();

        return response()->json($comments);
    }


    public function storeComment(Request $request)
    {

        $user_id = auth()->user()->id;

        $request->validate([
            // 'user_id' => "required|exists:users,id",
            'post_id' => "required|exists:posts,id",
            "comment" => "required|string|max:255",
        ]);

        $comment = Comment::create([
            'user_id' => $user_id,
            'post_id' => $request->post_id,
            "comment" => $request->comment,
            "ip_address" => $request->ip(),
        ]);
        $post = Post::findOrFail($comment->post_id);
        if ($post->user->id !== auth()->id()) {
            $post->user->notify(new NewCommentNotification($comment, $post));
        }


        $comment->load('user');
        if (!$comment) {
            return response()->json([
                'msg' => 'falid in creation',
                'status' => 403,

            ]);
        }
        return response()->json([
            'msg' => 'comment created successfuly',
            'comment' => $comment,
            'status' => 201,
        ]);
    }
}
