<?php

namespace App\Http\Middleware;

use Auth;
use View;
use Closure;

use App\Notification;

class StaffAccess
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

        if($user->role == 'staff' || $user->role == 'admin') {
            // navbar and sidebars items
            $auth = Auth::user();
            $notifications = Notification::getAllUnreadNotifications($auth->id);

            View::share('auth', $auth);
            View::share('user', $auth);
            View::share('userDetail', $auth->details);
            View::share('notifications', $notifications);

            return $next($request);
        } else {
            abort(403);
        }
    }
}
