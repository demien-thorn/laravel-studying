<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(length: 191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive(name: 'routeactive', handler: function ($route) {
            return "<?php echo Route::currentRouteNamed($route) ? 'class=\"menu-active\"' : '' ?>";
        });

        Blade::if(name: 'admin', callback: function () {
            return Auth::check() && Auth::user()->isAdmin();
        });
    }
}
