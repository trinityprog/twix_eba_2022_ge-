<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class Lang
{
    public function handle($request, Closure $next)
    {
        app()->setLocale(Cookie::get('lang', 'ru'));
        return $next($request);
    }
}
