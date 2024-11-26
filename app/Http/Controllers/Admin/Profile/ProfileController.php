<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Notifications\ProfileAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:profile');

    }
    public function index($email)
    {
        $admin = Admin ::where('email',$email)->first();
        return view('admin.profile.update',compact('admin'));
    }

    public function updateProfile(Request $request,$id){

        $admin = Admin::findOrFail($id);
        $request->validate($this->filterprofile());
        if($request->has('password') && $request->password != null ){
            $admin->update([
                'password'=>$request->password,
            ]);
        }
        $admin->update($request->except('_token','password'));

        return to_route('admin.profile.index',$admin->email)->with('success','profile update successfuly');

    }

    public function showverfiycode($email){
        // $admin = Admin ::where('email',$email)->first();

        // $admin->notify(new ProfileAdmin());
        // return view('admin.profile.varifycodeprofile' ,compact('email'));
        // $admin = Admin::findOrFail($id);
        $admin = Admin ::where('email',$email)->first();

        // Generate OTP and store it in the session
        $otp = rand(100000, 999999); // Example: 6-digit OTP
        session(['admin_otp' => $otp, 'admin_otp_expiration' => now()->addMinutes(10)]);

        // Send OTP to admin
        $admin->notify(new ProfileAdmin($otp));
        return view('admin.profile.varifycodeprofile', compact('email'))
            ->with('success', 'An OTP has been sent to your registered email.');
    }


    public function verfiycode(Request $request){

        $request->validate([
            'email'=>'required|email',
            'otp'=>'required|min:4',
           ]);
        // $otp = (new Otp)->validate($request->email, $request->otp);
        // if($otp->status == false)
        // {
        //     return redirect()->back()->withErrors(['otp'=>'code not valid!']);
        // }
        if ($request->otp != session('admin_otp')) {
            return back()->withErrors(['otp' => 'The OTP is incorrect. Please try again.']);
        }

        // Check if the OTP has expired
        if (now()->greaterThan(session('admin_otp_expiration'))) {
            return back()->withErrors(['otp' => 'The OTP has expired. Please request a new one.']);
        }
        return redirect()->route('admin.profile.index',['email'=>$request->email]);
    }





    public function filterprofile(){
        return[
            'name'=>"required|string|max:255",
            'email'=>'required|email|unique:admins,email,' . Auth::guard('admin')->user()->id,
            'username'=>"required|string|max:255",
            'password'=>"nullable",
        ];
    }
}
