<?php

namespace App\Providers;


use App\Model\History;
use App\Option;
use App\MasterSiteSetting;
use App;
use DB;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Tool;
use Illuminate\Support\Facades\View;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
        if (request()->get('ref') !== null) {
            session(['ref' => request()->get('ref')]);
        }
        $game = App\Model\Game::all();
        View::share('blogGame', $game);
        if (Schema::hasTable('tools')) {
            // Share tools list for all views
            $tools =  Tool::join('games', 'games.id', '=', 'tools.game_id')->select('tools.*', 'games.name AS game_name')->orderBy('game_id', 'desc')->get();
            $activeToolCount = 0;
            foreach ($tools as $tool) {
                if ($tool->active) {
                    $activeToolCount++;
                }
                $tool->package = json_decode($tool->package);
            }

            $topUserInMonth = "";
            foreach (History::select('user_id', DB::raw('SUM(amount) AS tong_tien'))->where('action', 'BUY_KEY')->groupBy('user_id')->orderBy('tong_tien', 'DESC')->limit(3)->get() as $data) {
                $topUserInMonth = $topUserInMonth . ', ID ' . $data->user_id . ': $' . $data->tong_tien;
            }
            $topUserInMonth = ltrim(trim($topUserInMonth), ', ');

            View::share('activeToolCount', $activeToolCount);
            View::share('topUserInMonth', $topUserInMonth);


        } else
            $tools = [];
        View::share('tools', $tools);

        $master_site_settings = MasterSiteSetting::find(1);
        View::share('master_site_settings', $master_site_settings);

        if (Schema::hasTable('options')) {
            $siteSettings = Option::select('option', 'value')->get()->keyBy('option')->pluck('value', 'option');
            View::share('siteSettings', $siteSettings);
        }

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            if (Auth::user()->type == 'support') {
                $event->menu->menu = [];
                $event->menu->add('SUPPORT PANEL');
                $event->menu->add([
                    'text' => 'Support',
                    'url' => '/support',
                ]);
                $event->menu->add('Thành viên');
                $event->menu->add([
                    'text' => 'User',
                    'url' => '/user',
                ]);
            }
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
