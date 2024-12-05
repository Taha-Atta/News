<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\utils\ImageManger;
use Illuminate\Http\Request;
use function App\Http\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Notifications\ApiVerifyOtpNotification;

class RegisterController extends Controller
{
    public function register(UserRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $user = $this->createUser($request);

            if(!$user){
                return ApiResponse(401,'try again');
            }

            if ($request->hasFile('image')) {
                ImageManger::uploadImage($request, null, $user);
            }
            $token = $user->createToken('user_token')->plainTextToken;
            $message = "this code for verify your email";
            $user->notify(new ApiVerifyOtpNotification( $message));

            DB::commit();
            return ApiResponse(201, 'user Created Successfuly', ['token' => $token]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error Regisrtion proccess' . $e->getMessage());
            return ApiResponse(504, 'user not creadted');
        }
    }


    public function createUser($request)
    {
        $user = User::create([
            'name' => $request->post('name'),
            'username' => $request->post('username'),
            'email' => $request->post('email'),
            'password' => $request->post('password'),
            'phone' => $request->post('phone'),
            'country' => $request->post('country'),
            'city' => $request->post('city'),
            'street' => $request->post('street'),
        ]);
        return $user;
    }
}
