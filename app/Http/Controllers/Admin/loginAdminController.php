<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class loginAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->only('logoutAdmin');
        $this->middleware('guest:admin')->only('showlogin', 'loginAdmin');
    }


    public function showlogin()
    {
        return view('admin.login');
    }



    public function loginAdmin(Request $request)
    {
        $request->validate($this->fillterlogin());

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {

            return redirect()->intended(RouteServiceProvider::ADMINHOME);
        };
        return redirect()->back()->withErrors(['email' => 'credentials dose not match !']);
    }

    private function fillterlogin(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
            'remember_me' => 'in:on,off'
        ];
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.show.login');
    }
}
