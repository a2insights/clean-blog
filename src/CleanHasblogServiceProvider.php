<?php

namespace Atiladanvi\CleanHasblog;

use Illuminate\Support\ServiceProvider;

/**
 * Class CleanHasblogServiceProvider
 *
 * @package Atiladanvi\CleanHasblog
 */
class CleanHasblogServiceProvider extends ServiceProvider
{
    /**
     * Boot the resources path
     * @void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/public/assets' => public_path('vendor/clean/assets'),
        ], 'clean/assets');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'clean');
    }

    /**
     * Register resources
     * @void
     */
    public function register()
    {

    }
}
