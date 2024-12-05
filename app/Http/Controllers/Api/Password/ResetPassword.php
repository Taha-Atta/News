<?php

namespace App\Http\Controllers\Api\Password;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

use function App\Http\ApiResponse;

class ResetPassword extends Controller
{
    public function resetPassword(Request $request)
    {


        $request->validate([
            'email' => 'required|email|exists:users,email|max:70',
            'code' => 'required|min:4',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

        $key = 'resetPassword:' . $request->email . ':' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 1)) {
            $time = RateLimiter::availableIn($key);
            return ApiResponse(429, 'try agin after '  . gmdate("H:i:s", $time) . ' (hh:mm:ss).');
        }
        RateLimiter::hit($key, 60);
        $remain = RateLimiter::remaining($key, 1);

        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return ApiResponse(404, 'user not found');
        }
        $otp = (new Otp)->validate($user->email, $request->code);

        if ($otp->status == false) {
            return ApiResponse(301, 'code is invalid');
        }
        $user->update(['password' => Hash::make($request->password)]);
        return ApiResponse(200, 'password updated  successfuly', ['remaining_attempts' => $remain]);
    }
}
