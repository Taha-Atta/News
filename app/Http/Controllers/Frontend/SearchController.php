<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'search'=>'nullable|string|max:100'
        ]);

        $keyword = strip_tags($request->search);


        $posts = Post::active()->where('title', 'LIKE', '%' . $keyword . '%')
            ->orwhere('description', 'LIKE', '%' . $keyword . '%')
            ->paginate(9);

        return view('frontend.search',compact('posts'));
    }
}
