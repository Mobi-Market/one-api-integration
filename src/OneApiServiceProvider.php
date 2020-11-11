<?php

declare(strict_types=1);

/*
 * This file is part of a Proprietary System.
 * Copyright belongs to the license holder. No license is given for its use outside
 * the license holders systems.
 */

namespace MobiMarket\OneApi;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class OneApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/one-api.php' => config_path('one-api.php'),
        ], 'one-api');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/one-api.php', 'one-api');

        $this->app->singleton(OneApiRestApi::class, function (Application $app) {
            $config = $app->make('config');

            return new OneApiRestApi(
                $config->get('one-api.api.url'),
                $config->get('one-api.api.timeout'),
                $config->get('one-api.api.should_log'),
                $config->get('one-api.key')
            );
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [OneApiRestApi::class];
    }
}
