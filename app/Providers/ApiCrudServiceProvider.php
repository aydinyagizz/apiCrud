<?php

namespace App\Providers;

use App\Services\Interfaces\ProductInterface;
use App\Services\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ApiCrudServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        app()->bind(ProductInterface::class, ProductRepository::class);
       // app()->singleton(ProductInterface::class, ProductRepository::class);
        //singleton bir kez oluşturulur ve onu kullanır
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
