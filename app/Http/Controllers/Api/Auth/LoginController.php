<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

use function App\Http\ApiResponse;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if(RateLimiter::tooManyAttempts($request->ip(),2)){
            $time = RateLimiter::availableIn($request->ip());
            return ApiResponse(429,'try agian after '. $time . ' seconds');
        }

        $remain = RateLimiter::remaining($request->ip(),2);

        RateLimiter::increment($request->ip());

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            RateLimiter::clear($request->ip());
            $token = $user->createToken('user_token',[],now()->addMinute(60))->plainTextToken;
            return ApiResponse(200, 'user login successfuly', ['token' => $token]);
        }

        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     $user = User::where('email',$request->email)->first();
        //     $token = $user->createToken('user_token')->plainTextToken;

        //     return ApiResponse(200,'user login successfuly',['token'=>$token]);
        // }
        return ApiResponse(404, 'info wrong',['remain'=> $remain]);
    }




    public function logout()
    {

        $user =  Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();
        return ApiResponse(200, 'user logout successfuly');
    }
}
