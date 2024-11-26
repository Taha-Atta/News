<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\VirfayOtpNotification;

class FrogetPasswordController extends Controller
{
    public function showEmail()
    {
        return view('admin.password.email');
    }



    public function checkEmail(Request $request)
    {
       $request->validate([
        'email'=>'required|email',
       ]);

       $Admin = Admin::where('email',$request->email)->first();
       if(!$Admin)
       {
        return redirect()->back()->withErrors(['email'=>'try again latter !']);
       }

       $Admin->notify(new VirfayOtpNotification());
       return to_route('admin.password.confirm.code',['email'=>$Admin->email]);
    }

    public function confirmcode($email)
    {

        return view('admin.password.confiram',['email'=>$email]);
    }



    public function verfiyOtp(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'otp'=>'required|min:4',
           ]);
        $otp = (new Otp)->validate($request->email, $request->otp);
        if($otp->status == false)
        {
            return redirect()->back()->withErrors(['otp'=>'code not valid!']);
        }

        return redirect()->route('admin.password.show.Reset',['email'=>$request->email]);

    }




}
