<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestLimit
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
        if(auth()->user()->tests()->whereDate('created_at', today())->count() >= config('limits.TESTS_PER_DAY'))
            return redirect('/#test-limit');
        return $next($request);
    }
}
