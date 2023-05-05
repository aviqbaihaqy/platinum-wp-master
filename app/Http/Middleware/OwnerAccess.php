<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Request;

class OwnerAccess
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
        $auth = Auth::user();
        $user_id = Request::route()->parameter('user_id');

        if($auth->id != $user_id)
            if($auth->role == 'user')
                abort(403);

        return $next($request);
    }
}
