<?php

namespace App\Http\Controllers\Api\Password;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ApiVerifyOtpNotification;

use function App\Http\ApiResponse;

class ForgetPassword extends Controller
{
    public function forgetPassword(Request $request){

        $request->validate([
            'email'=>"required|email|exists:users,email|max:70"
        ]);

        $user = User::whereEmail($request->email)->first();
        if(!$user){
            return ApiResponse(404,'user not found');
        }
        $message = "this code for rest your password";
        $user->notify(new ApiVerifyOtpNotification($message));

        return ApiResponse(200,'code send to your email');

    }
}
