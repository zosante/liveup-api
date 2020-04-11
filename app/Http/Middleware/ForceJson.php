<?php

namespace App\Http\Middleware;

use Closure;

class ForceJson
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param array $guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        if (in_array('api', $guards) || $request->segment(1) === 'api') {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
