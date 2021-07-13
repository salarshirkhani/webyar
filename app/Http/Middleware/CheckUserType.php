<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $type
     * @return mixed
     */
    public function handle($request, Closure $next, string $type)
    {
        $user = \Auth::authenticate();
        if ($user->type != $type) {
            return redirect()->route('dashboard.index');
        }

        return $next($request);
    }
}
