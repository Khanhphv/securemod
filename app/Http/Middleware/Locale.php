<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use App\Service\CommonService;
use Closure;
use App;

class Locale
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
        $language = $request->session()->get('website_language');
        //get all of games
        $allGames = App\Model\Game::all(['id', 'name', 'slug']);
        if(\Auth::check()) {
            // xác định role của member
            $role = CommonService::roleMember();
            \View::share('role', $role);
        }
        \View::share('allGames', $allGames);
        App::setLocale($language);
        return $next($request);
    }
}
