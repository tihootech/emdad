<?php

namespace App\Http\Middleware;

use Closure;

class CheckMaster
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
        $user = auth()->user();
        if ($user->type == 'master') {
            return $next($request);
        }else {
            abort(404);
        }
    }
}
