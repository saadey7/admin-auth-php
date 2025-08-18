<?php

namespace Mughal\AdminAuth\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.showlogin');
        }
        return $next($request);
    }
}
