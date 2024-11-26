<?php

namespace App\Http\Controllers\Admin\post;

use App\Models\Post;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use App\utils\ImageManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\PostRequest;

class postController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:posts');
        $this->middleware('can:create-post')->only('create');
        $this->middleware('can:edit-post')->only('edit');
        $this->middleware('can:delete-post')->only('destroy');
        $this->middleware('can:show-post')->only('show');

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::when(request()->keyword, function ($query) {
            $query->where('title', 'LIKE', '%' . request()->keyword . '%');
        })->when(!is_null(request()->status), function ($query) {
            $query->where('status', request()->status);
        })
            ->orderBy(request('sort_by', 'id'), request('order_by', 'asc'))
            ->paginate(request('limit_by', 15));

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        try {

            DB::beginTransaction();
            $request->merge([
                'admin_id'=>auth('admin')->user()->id,
            ]);
            $post = Post::create($request->except('images', '_token'));
            ImageManger::uploadImage($request, $post);
            DB::commit();
            Cache::forget('read_more_posts');
            Cache::forget('latest_posts');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        Session::flash('success', 'Post created succesuufly');
        return to_route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mainPost = Post::with('comments')->findOrFail($id);
        return view('admin.posts.show',compact('mainPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $post = Post::findOrFail($id);
            $post->update($request->except('images', '_token'));
            if($request->hasFile('images')){
                ImageManger::deleteImage($post);
                ImageManger::uploadImage($request, $post);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors', $e->getMessage()]);
        }



        Session::flash('success', 'post updated successfuly');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        ImageManger::deleteImage($post);
        $post->delete();
        Session::flash('success', 'post deleted successfuly');
        return redirect()->route('admin.posts.index');
    }

    public function changeStatus($id)
    {
        $post = Post::findOrFail($id);
        if ($post->status == 0) {
            $post->update([
                'status' => 1
            ]);
            Session::flash('success', 'post active successfuly');
        } else {
            $post->update([
                'status' => 0
            ]);
            Session::flash('success', 'post blocked successfuly');
        }

        return redirect()->back();
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

    public function deletePostComment($id){
      $comment=Comment::findOrFail($id);
      $comment->delete();
      Session::flash('success','Comment deleted successfuly');
      return redirect()->back();
    }
}
