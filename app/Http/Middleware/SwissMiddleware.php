<?php

namespace App\Http\Middleware;

use Closure;

class SwissMiddleware
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
        if (!$request->header('Token')) {
            abort(401, 'authentication failed');
        }
        return $next($request);
    }
}
