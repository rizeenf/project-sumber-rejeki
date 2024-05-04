<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $mainMenus = MainMenu::all();
        // $menus = Menu::all();
        // $submenus = SubMenu::all();

        // view()->share([
        //     'mainMenus' => $mainMenus,
        //     // 'menus' => $menus,
        //     // 'submenus' => $submenus
        // ]);
        Paginator::useBootstrapFive();
    }
}
