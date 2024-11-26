<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use App\utils\ImageManger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\PostRequest;
use App\Http\Requests\Frontend\AddPostRequest;

class ProfileController extends Controller
{
    public function index()
    {
        // $posts = auth()->user()->posts()->active()->with(['images'])->get();
        $posts = Post::active()->with('images')->where('user_id', auth()->user()->id)->latest()->get();
        return view('frontend.dashboard.profile', compact('posts'));
    }


    public function addPost(PostRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $this->Commentable($request);
            $post = Post::create($request->except('images', '_token'));
            ImageManger::uploadImage($request, $post);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }
        Session::flash('success', 'post created successfuly');
        return redirect()->back();
    }



    public function editPost(Request $request, $slug)
    {
        $post = Post::with('images')->whereSlug($slug)->first();
        return view('frontend.dashboard.edit-post', compact('post'));
    }


    public function updatePost(PostRequest $request, $id)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $post = Post::findOrFail($id);
            $this->Commentable($request);
            $post->update($request->except('images', '_token'));
            ImageManger::uploadImage($request, $post);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }



        Session::flash('success', 'post updated successfuly');
        return redirect()->route('frontend.dashboard.profile');
    }

    private function Commentable($request)
    {
        return  $request->comment_able == "on" ? $request->merge(['comment_able' => 1])
            : $request->merge(['comment_able' => 0]);
    }




    public function deletePostImage($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json([
                'status' => 201,
                'msg' => 'image not found',
            ]);
        }
        // delete from local
        if (File::exists(public_path($image->path))) {
            File::delete(public_path($image->path));
        }
        // delete from database
        $image->delete();
        return response()->json([
            'status' => 201,
            'msg' => 'image deleted successfuly',
        ]);
    }


    public function deletePost($slug)
    {
        $post = Post::whereSlug($slug)->first();
        if (!$post) {
            abort(404);
        }
        ImageManger::deleteImage($post);
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfuly');
    }


    public function commentPost($id)
    {

        $comments = Comment::with('user')->where('post_id', $id)->get();

        if (!$comments) {
            return response()->json([
                'data' => 'no data',
                'msg' => 'no comments'
            ]);
        }
        return response()->json([
            'data' => $comments,
            'msg' => 'contain comments'
        ]);
    }
}
