<?php

namespace App\utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class ImageManger
{

    public static function uploadImage($request, $post = null, $user = null)
    {
              // upload multie images
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $file = $image;
                $imageName = self::genrateImageName($file);
                $path = self::storeImageInPath($file,'profile',$imageName);
                $post->images()->create([
                    'path' => $path,
                ]);
            }
        }
        // upload singl image
        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            };

            $file = $request->image;
            $imageName = self::genrateImageName($file);
            $path = self::storeImageInPath($file,'user',$imageName);
            $user->update(['image' => $path]);
        }
    }

    public static function deleteImage($post)
    {
        if ($post->images->count() > 0) {

            foreach ($post->images as $image) {

                if (File::exists(public_path($image->path))) {
                    File::delete(public_path($image->path));
                }
                $image->delete();
            }
        }
    }



    public static function genrateImageName($file){
        $imageName = Str::uuid() . time() . $file->getClientOriginalExtension();
        return $imageName;
    }

    public static function storeImageInPath($file,$namefolder,$imageName,){
        $path = $file->storeAs('upload/'.$namefolder, $imageName, ['disk' => 'uploads']);
        return $path;

    }


    public function DeleteOneImage($image){
        if (File::exists(public_path($image->path))) {
            File::delete(public_path($image->path));
        }
    }
}
