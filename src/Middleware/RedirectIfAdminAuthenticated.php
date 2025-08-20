<?php

namespace Mughal\AdminAuth\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuthenticated
{
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->check()) {
            return redirect(config('adminauth.redirect_to', '/admin'));
        }

        return $next($request);
    }
}
