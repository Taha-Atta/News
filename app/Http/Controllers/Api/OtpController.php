<?php

namespace App\Http\Controllers\Api;

use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use function App\Http\ApiResponse;

use App\Http\Controllers\Controller;
use App\Notifications\ApiVerifyOtpNotification;

class OtpController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'code' => "required|min:4",
        ]);
        $user = $request->user();
        $otp = (new Otp)->validate($user->email, $request->code);

        if ($otp->status == false) {
            return ApiResponse(301, 'code is invalid');
        }
        $user->update(['email_verified_at' => now()]);
        return ApiResponse(200, 'Email verified successfuly');
    }

    public function sendCodeAgian(){

        $user = request()->user();
        $message="this message for send again your code";
        $user->notify(new ApiVerifyOtpNotification( $message));


        return ApiResponse(200, 'code send again');
    }
}
