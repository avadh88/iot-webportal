<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RedisService;

class RedisServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RedisService::class, function ($app) {
            return new RedisService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
