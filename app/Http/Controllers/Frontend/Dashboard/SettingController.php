<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\User;
use App\utils\ImageManger;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Frontend\SettingRequest;

class SettingController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        return view('frontend.dashboard.setting', compact('user'));
    }

    public function updateSetting(SettingRequest $request)
    {

        $request->validated();

        $user = User::findOrFail(auth()->user()->id);

        $user->update($request->except(['image', '_token']));

        ImageManger::uploadImage($request,null,$user);

        return redirect()->back()->with('success', 'information updated successfuly');
    }

    public function changepassword(Request $request){

        $user=  User::findOrFail(auth()->user()->id);
        // return $user;
        $request->validate($this->validationofpassword());


        if(!Hash::check($request->current_password,$user->password)){
            Session::flash('error','password dosnt match !');
            return redirect()->back();
        }

        $user->update([
            'password'=>Hash::make($request->password),
        ]);
            Session::flash('success','password updated successfuly');
            return redirect()->back();
    }



    private function validationofpassword():array
    {

         return[
            'current_password'=>'required',
            'password'=>'required|confirmed|string|min:8',
            'password_confirmation'=>'required',
         ];
    }
}
