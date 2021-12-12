<?php

namespace OZiTAG\Tager\Backend\Banners;

use Illuminate\Support\ServiceProvider;
use OZiTAG\Tager\Backend\Banners\Console\TagerBannersUpdateStatusesCommand;
use OZiTAG\Tager\Backend\Banners\Enums\TagerBannersScope;
use OZiTAG\Tager\Backend\Rbac\TagerScopes;

class BannersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            TagerBannersUpdateStatusesCommand::class
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'tager-banners');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        TagerScopes::registerGroup(__('tager-banners::scopes.group'), [
            TagerBannersScope::View => __('tager-banners::scopes.view'),
            TagerBannersScope::Create => __('tager-banners::scopes.create'),
            TagerBannersScope::Edit => __('tager-banners::scopes.edit'),
            TagerBannersScope::Delete => __('tager-banners::scopes.delete'),
        ]);

        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command('cron:tager-banners:update-statuses')->daily();
        });
    }
}
