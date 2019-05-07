<?php

namespace CleanHasBlog;

use Illuminate\Support\ServiceProvider;

/**
 * Class CleanHasBlogServiceProvider
 * @package MaterialAdmin
 */
class CleanHasBlogServiceProvider extends ServiceProvider
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

        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views/vendor/clean'),
        ], 'clean/views');

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
