<?php

namespace Wazen\Laravel;

use Illuminate\Support\ServiceProvider;
use Wazen\Wazen;

class WazenServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/wazen.php', 'wazen');

        $this->app->singleton(Wazen::class, function ($app) {
            $config = $app['config']['wazen'];

            return new Wazen($config['api_key'] ?? '', [
                'base_url' => $config['base_url'],
                'timeout' => $config['timeout'],
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/wazen.php' => config_path('wazen.php'),
            ], 'wazen-config');
        }
    }
}
