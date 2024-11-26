<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NotifactionController extends Controller
{


    public function showNotification()
    {
        auth()->user()->unreadNotifications->markAsRead();
        $notificationss = auth()->user()->Notifications()->paginate(7);
        return view('frontend.dashboard.notifaction',compact('notificationss'));
    }

    public function markeAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }




    public function deleteAll()
    {
        auth()->user()->notifications()->delete();
        Session::flash('success', 'Notification deleted successfuly');
        return redirect()->back();
    }



    public function deleteItem($notificaion_id)
    {
        $notification = auth()->user()->notifications()->where('id', $notificaion_id)->first();

        $notification->delete();
        Session::flash('success', 'Notification deleted successfuly');
        return redirect()->back();
    }
}
