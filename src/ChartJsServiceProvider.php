<?php

namespace IlBronza\ChartJs;

use Illuminate\Support\ServiceProvider;

class ChartJsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'chartjs');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chartjs');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/chartjs.php', 'chartjs');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chartjs');

        // Register the service the package provides.
        $this->app->singleton('chartjs', function ($app) {
            return new ChartJs;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['chartjs'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing assets.
        $this->publishes([
            __DIR__.'/../resources/assets' => base_path('resources'),
        ], 'chartjs.assets');

        // Publishing the configuration file.
        // $this->publishes([
        //     __DIR__.'/../config/chartjs.php' => config_path('chartjs.php'),
        // ], 'chartjs.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ilbronza'),
        ], 'chartjs.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ilbronza'),
        ], 'chartjs.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ilbronza'),
        ], 'chartjs.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
