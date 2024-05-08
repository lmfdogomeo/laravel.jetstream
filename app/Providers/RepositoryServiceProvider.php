<?php

namespace App\Providers;

use App\Repositories\Contracts\MerchantRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\MerchantRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            MerchantRepositoryInterface::class,
            MerchantRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
