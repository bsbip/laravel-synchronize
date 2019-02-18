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

    protected function registerPublishments()
    {
        $this->publishes([
            __DIR__ . '/../config/synchronizer.php' => config_path('synchronizer.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'migrations');
    }

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
