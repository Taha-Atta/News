<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function App\Http\ApiResponse;

class checkstatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth('web')->check() && auth('web')->user()->status == 0){
            return to_route('frontend.checkstatus');
            // return response()->view('wait');

        }
        if(Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->status == 0){
            Auth::guard('sanctum')->user()->currentAccessToken()->delete();
            return ApiResponse(403,'your blocked contacted with admin');
        }
        return $next($request);
    }
}
