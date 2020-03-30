<?php

namespace commando1251\Archive\Laravel;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ArchiveServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('archive', function ($app) {
            $return = $app->make('Commando1251\\Archive\\ArchiveCreator');

            return $return;
        });

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Archive', 'Commando1251\\Archive\\Laravel\\Facades\\Archive');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['archive'];
    }
}