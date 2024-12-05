<?php

namespace App\Http\Controllers\Api\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Auth;

use function App\Http\ApiResponse;

class NotificationController extends Controller
{
    public function getNotification()
    {
        $user = Auth::guard('sanctum')->user();
        $notifications =  $user->notifications;
        $unreadNotifications =   $user->unreadNotifications;
        return ApiResponse(200, 'notification found', [
            'notifications' => NotificationResource::collection($notifications),
            'unreadNotifications' =>  NotificationResource::collection($unreadNotifications),
        ]);
    }

    public function ReadNotification($id)
    {
        // $notification = Auth::guard('sanctum')->user()->unreadNotifications()->where('id', $id)->first();
        $notification = Auth::guard('sanctum')->user()->notifications()->where('id', $id)->first();
        if (!$notification) {
            return ApiResponse(404, 'this notification not found');
        }
        if ($notification->read_at == null) {
            $notification->markAsRead();
            return ApiResponse(200, 'this notification read aready now');
        } else {

            return ApiResponse(404, 'this notification read befor');
        }
    }
}
