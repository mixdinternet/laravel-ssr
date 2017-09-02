<?php

namespace Mixdinternet\SSR\Providers;

use Illuminate\Support\ServiceProvider;

class SSRServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if(config('ssr.enable') === true) {
            $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
            $kernel->pushMiddleware(\Mixdinternet\SSR\Middleware\SSRMiddleware::class);
        }

        $this->publishes([
            __DIR__.'/../config/ssr.php' => config_path('ssr.php')
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ssr.php', 'ssr'
        );
    }
}
