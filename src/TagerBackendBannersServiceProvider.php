<?php

namespace OZiTAG\Tager\Backend\Banners;

use Illuminate\Support\ServiceProvider;
use Kalnoy\Nestedset\NestedSetServiceProvider;
use OZiTAG\Tager\Backend\Mail\Commands\FlushMailTemplatesCommand;
use OZiTAG\Tager\Backend\Banners\Commands\FlushBannersCommand;
use OZiTAG\Tager\Backend\Settings\Commands\FlushSettingsCommand;

class TagerBackendBannersServiceProvider extends ServiceProvider
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
