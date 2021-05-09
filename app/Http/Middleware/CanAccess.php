<?php


namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CanAccess
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
            if (auth()->user()->isSupport() or auth()->user()->isAdmin() ) {
                return $next($request);
            }
        }
        return redirect('/');
    }
}
