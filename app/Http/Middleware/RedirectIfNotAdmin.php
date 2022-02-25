<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAdmin
{

    public function handle($request, Closure $next)
    {
        if($request->user()->role != 'admin')
        {
            return redirect('/');
        }

        return $next($request);
    }
}
