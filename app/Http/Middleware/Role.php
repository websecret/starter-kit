<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws AuthorizationException
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->guest()) {
            return redirect('admin/login');
        }

        if (auth()->user()->isNotAn($role)) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
