<?php

namespace App\Providers;

use App\Services\ApiResponser\ApiResponser;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('api-responser', fn() => new ApiResponser());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
