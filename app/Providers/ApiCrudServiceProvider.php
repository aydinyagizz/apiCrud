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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
