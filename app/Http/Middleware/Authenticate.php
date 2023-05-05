<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $requestedRoute = Route::currentRouteName();

            if(starts_with($requestedRoute, 'dashboard.'))
                return route('login.staff');
            else
                return route('login');
        }
    }
}
