<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\RelateNewsSite;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
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
        $setting_info = Setting::firstOr(function(){
            return Setting::create([
                'site_name'=>'News',
                'favicon'=>'default',
                'email'=>'news@gmial.com',
                'logo'=>'/test/logo.png',
                'facebook'=>'https://www.facebook.com/',
                'twitter'=>'https://www.twitter.com/',
                'instagram'=>'https://www.instagram.com/',
                'youtube'=>'https://www.youtube.com/',
                'phone'=>'0122585858',
                'country'=>'saudi arabia',
                'city'=>'taif',
                'street'=>'khald',

            ]);
        });
        // $setting_info = Setting::find(1);

        $setting_info->wathsapp = "https://wa.me/".$setting_info->phone;

        view()->share([
            'setting_info'=>$setting_info,

        ]);
    }
}
