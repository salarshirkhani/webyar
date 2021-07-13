<?php

namespace App\Http\Middleware;

use Closure;

class CheckForSuperuser
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
        if (!Auth::check() || \Auth::user()->type != 'admin') {
            abort(403);
        }
        return $next($request);
    }
}
