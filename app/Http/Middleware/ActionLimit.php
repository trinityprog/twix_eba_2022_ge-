<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActionLimit
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
        if($request->route()->parameter('type') == 'confirm' || $request->input('type') == 'confirm')
            return $next($request);

        if(config('limits.ACTION') == 'checks') {
            $count = auth()->user()->checks()
                ->typeRegular()
                ->whereDate('created_at', today())
                ->count();
            $redirectTo = '/#already-uploaded';
        }

        else {
            $count = auth()->user()->scanners()
                ->whereDate('created_at', today())
                ->count();
            $redirectTo = '/';
        }


        if($count >= config('limits.ACTIONS_PER_DAY'))
            return redirect($redirectTo);

        return $next($request);
    }
}
