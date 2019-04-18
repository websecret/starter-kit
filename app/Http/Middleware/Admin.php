<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws AuthorizationException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guest()) {
            return redirect('admin/login');
        }

        if (!auth()->user()->canAccessRoute($request->route()->getName())) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
