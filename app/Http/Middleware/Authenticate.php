<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->guest()) {
            return redirect('admin/login');
        }

        return $next($request);
    }
}