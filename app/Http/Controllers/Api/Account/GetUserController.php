<?php

namespace App\Http\Controllers\Api\Account;

use Illuminate\Http\Request;
use function App\Http\ApiResponse;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\RateLimiter;

class GetUserController extends Controller
{
    public function getUser()
    {


        $key = request()->ip();
        if (RateLimiter::tooManyAttempts($key, 1)) {
            $timeInSeconds = RateLimiter::availableIn($key);
            $days = floor($timeInSeconds / 86400); // Total seconds in a day
            $hours = floor(($timeInSeconds % 86400) / 3600); // Remaining seconds after days
            $minutes = floor(($timeInSeconds % 3600) / 60); // Remaining seconds after hours

            // Create a human-readable message
            $timeMessage = $days > 0
                ? "try again after $days day(s)"
                : ($hours > 0
                    ? "try again after $hours hour(s)"
                    : "try again after $minutes minute(s)");
            return ApiResponse(429, 'try agian after ' . $timeMessage);
        }
        RateLimiter::increment($key, 17000);
        $reamin = RateLimiter::remaining($key, 1);
        $user = request()->user();
        return ApiResponse(200, 'this user', [
            'user' => new UserResource($user),
            'remaing' => $reamin
        ]);
    }
}
