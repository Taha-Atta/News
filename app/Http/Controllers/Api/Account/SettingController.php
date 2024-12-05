<?php

namespace App\Http\Controllers\Api\Account;

use App\Models\User;
use App\utils\ImageManger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SettingRequest;
use Illuminate\Support\Facades\Hash;

use function App\Http\ApiResponse;

class SettingController extends Controller
{
    public function updateSetting(SettingRequest $request, $user_id)
    {

        $request->validated();
        $user = User::find(request()->user()->id);

        $user->update($request->except(['image', '_method']));

        ImageManger::uploadImage($request, null, $user);

        return ApiResponse(200, 'setting updated successuly');
    }

    public function updatePassword(Request $request, $user_id)
    {
        $request->validate([
            'current_password'=>"required|min:8",
            'password'=>"required|min:8|confirmed",
            'password_confirmation'=>"required|min:8",
        ]);
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return ApiResponse(403, 'info dosent match');
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return ApiResponse(200, 'password updated successfuly');
    }
}
