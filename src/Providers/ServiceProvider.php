<?php

namespace LaravelSynchronize\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelSynchronize\Console\Commands\MakeSynchronizationCommand;
use LaravelSynchronize\Console\Commands\SynchronizeCommand;

/**
 * Service provider
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishments();

        $this->bootCommands();
    }

    /**
     * Register the config and migration file for publishing
     *
     * @return void
     * @author Roy Freij <Roy@bsbip.com>
     * @version 2019-03-08
     */
    protected function registerPublishments()
    {
        $this->publishes([
            __DIR__ . '/../config/synchronizer.php' => config_path('synchronizer.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Let Laravel know these commands are available
     *
     * @return void
     * @author Roy Freij <Roy@bsbip.com>
     * @version 2019-03-08
     */
    private function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeSynchronizationCommand::class,
                SynchronizeCommand::class,
            ]);
        }
    }
}
