<?php

namespace Octo\CleanBlog;

use Illuminate\Support\ServiceProvider;

class CleanBlogServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/public/assets' => public_path('vendor/octo/themes/clean-blog/assets'),
        ], 'clean/assets');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'clean');
    }

    public function register()
    {

    }
}
