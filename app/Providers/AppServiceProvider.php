<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
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
            return "<?php echo Route::currentRouteNamed($route) ? 'active' : 'text-white' ?>";
        });

        Blade::if(name: 'admin', callback: function () {
            return Auth::check() && Auth::user()->isAdmin();
        });

        Product::observe(classes: ProductObserver::class);
    }
}
