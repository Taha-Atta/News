<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(!Cache::has('read_more_posts')){
            $read_more_posts = Post::select('id','slug','title')->latest()->limit(10)->get();
            cache::remember('read_more_posts',3600,function() use($read_more_posts){
                return  $read_more_posts;
            });
        }

        //latest_posts

        if(!Cache::has('latest_posts')){
            $latest_posts = Post::select('id','slug','title')->latest()->limit(4)->get();
            Cache::remember('latest_posts',3600,function()use($latest_posts){
                return  $latest_posts;
            });

        }

        //great_posts_commemt
        if(!cache::has('great_posts_commemt')){
            $great_posts_commemt = Post::withCount('comments')->orderby('comments_count','desc')->take(4)->get();
            cache::remember('great_posts_commemt',3600,function()use($great_posts_commemt){
                return  $great_posts_commemt;
            });

        }

        // get data from cache
        $read_more_posts = cache::get('read_more_posts');
        $latest_posts = cache::get('latest_posts');
        $great_posts_commemt = cache::get('great_posts_commemt');


        // share data
        view()->share([
            'read_more_posts'=> $read_more_posts,
            'latest_posts'=> $latest_posts,
            'great_posts_commemt'=> $great_posts_commemt,
        ]);

    }
}
