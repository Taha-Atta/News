<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:notify');

    }
    public function index()
    {
        $notifications = Auth::guard('admin')->user()->notifications()->paginate(7);
        auth('admin')->user()->unreadNotifications->markAsRead();
        return view('admin.notification.index',compact('notifications'));
    }


    public function deleteAll()
    {
        auth('admin')->user()->notifications()->delete();
        Session::flash('success', 'Notification deleted successfuly');
        return redirect()->back();
    }



    public function deleteItem($notificaion_id)
    {
        $notification = auth('admin')->user()->notifications()->where('id', $notificaion_id)->first();

        $notification->delete();
        Session::flash('success', 'Notification deleted successfuly');
        return redirect()->back();
    }
}
