<?php

namespace App\Providers;

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
        //ApiCrudServiceProvider::register();
        // ApiCrudServiceProvider sınıfını statik olmayan şekilde çağırmalısınız

        //$provider = app()->make(\App\Providers\ApiCrudServiceProvider::class);
        //$provider->register(); // Statik değil, örnek üzerinden çağrılıyor.
    }
}
