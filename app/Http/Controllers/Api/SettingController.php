<?php

namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\RelateNewsSite;
use function App\Http\ApiResponse;
use App\Http\Controllers\Controller;

use App\Http\Resources\SettingResource;
use App\Http\Requests\Frontend\SettingRequest;
use App\Http\Resources\RelatedNewsResource;

class SettingController extends Controller
{
    public function showSetting(){
        $setting = Setting::first();
        $related_sites = RelateNewsSite::get();

        if(!$setting){
            return ApiResponse(404,'setting Not Found');
        }
        if(!$related_sites){
            return ApiResponse(404,'related sites Not Found');
        }
        $data = [
            'setting'=>SettingResource::make($setting),
            'related_sites'=>RelatedNewsResource::collection($related_sites),
        ];

        return ApiResponse(200,'this is setting',$data);
    }
}
