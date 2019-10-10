<?php

namespace App\Http\Middleware;

use Closure;

class CheckOnlyOrgan
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
        if ( only_organ() ) {
            return $next($request);
        }else {
            return redirect('login');
        }
    }
}
