<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        die();
        if (!$request->user()->hasRole($role)) {
            abort(401, 'This action is unauthorized.');
            return false;
        }
        return $next($request);
    }
}
