<?php

namespace OZiTAG\Tager\Backend\Banners;

use Illuminate\Support\ServiceProvider;
use OZiTAG\Tager\Backend\Banners\Console\FlushBannersCommand;

class BannersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->publishes([
            __DIR__ . '/../config.php' => config_path('tager-banners.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FlushBannersCommand::class,
            ]);
        }
    }
}
