<?php


namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;


class IsSupport
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (auth()->user()->isSupport()) {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
