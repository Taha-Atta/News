<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showReset($email)
    {

        return view('admin.password.reset', ['email' => $email]);
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);
        $admin  = Admin::where('email', $request->email)->first();
        if (!$admin) {
            return redirect()->back()->with('error', 'try agian latter!');
        }
        $admin->update([
            'password' => Hash::make($request->password),
        ]);
        return to_route('admin.show.login');
    }
}
