<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Checkreadnotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->query('notifica')) {
            // dd($request->query('notification'));
            $notifiay = auth()->user()->unreadNotifications()->where('id', $request->query('notifica'))->first();
            if ($notifiay == null) {
                return $next($request);
            };

            $notifiay->markAsRead();
        }
        if ($request->query('notifiy_admin')) {
            $notifiay = auth('admin')->user()->unreadNotifications()->where('id', $request->query('notifiy_admin'))->first();
            if ($notifiay == null) {
                return $next($request);
            };

            $notifiay->markAsRead();
        }

        return $next($request);
    }
}
