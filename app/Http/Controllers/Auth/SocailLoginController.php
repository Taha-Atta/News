<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocailLoginController extends Controller
{
    public function redirect($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        try {
            $user = Socialite::driver($provider)->user();

            $user_db1 = User::where('email', $user->email)->first();
            if ($user_db1) {
                Auth::login($user_db1);
                return to_route('frontend.index');
            }
            $user_db = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'username' => Str::slug($user->name).time(),
                'image' => $user->avatar,
                'country' => 'undifined',
                'city' => 'undifined',
                'street' => 'undifined',
                'phone' => rand(0, 9) . time(),
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(8)),

            ]);

            Auth::login($user_db);
            return to_route('frontend.index');
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }



}
