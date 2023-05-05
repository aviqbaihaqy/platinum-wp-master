<?php

namespace App\Http\Middleware;

use Auth;
use View;
use Closure;

use App\Notification;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if($user->role == 'admin') {
            // navbar and sidebars items
            $auth = Auth::user();
            View::share('auth', $auth);

            return $next($request);
        } else {
            abort(403);
        }
    }
}
