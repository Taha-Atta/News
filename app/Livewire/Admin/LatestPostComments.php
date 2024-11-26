<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;


class LatestPostComments extends Component
{
    public function render()
    {

        $latestPosts = Post::withCount('comments')->whereStatus(1)->latest()->take(7)->get();
        $latestComment = Comment::latest()->take(5)->get();
        return view('livewire.admin.latest-post-comments',[
            'latestPosts'=>$latestPosts,
            'latestComment'=>$latestComment,
        ]);
    }
}
