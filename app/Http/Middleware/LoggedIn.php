<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class LoggedIn
{
    public function handle(Request $request, \Closure $next)
    {
        $user = $request->user();

        if(empty($user))
        {
            return response()->json(['message' => 'Authorization required'], 401);
        }

        $user->markSeen();

        return $next($request);
    }
}
