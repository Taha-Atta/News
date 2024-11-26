<?php

namespace App\Providers;



use App\Models\Post;
use App\Models\Category;
use App\Models\RelateNewsSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewProviderService extends ServiceProvider
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


        // related sites
        $related_site = RelateNewsSite::select('name','url')->get();

        // categories
        $categories  = Category::select('id','name','slug')->get();

        view()->share([
           'related_site'=>$related_site,
           'categories'=>$categories,
        ]);
    }
}
