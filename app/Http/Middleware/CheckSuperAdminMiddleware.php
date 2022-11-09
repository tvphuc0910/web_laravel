<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class CheckSuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('level') === 0) {
            throw new \Exception('you cant do that');
        }
        return $next($request);
    }
}
