<?php

namespace Dmiknys\LaravelModularGenerator\Providers;

use Dmiknys\LaravelModularGenerator\Console\Commands\MakeDtoCommand;
use Illuminate\Support\ServiceProvider;

class LaravelModularGeneratorServiceProvider extends ServiceProvider
{
    public const CONFIG = 'laravel-modular-generator';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-modular-generator.php'),
            ], 'config');

             $this->commands($this->getCommands());
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'config');
    }

    private function getCommands(): array
    {
        $config = config(self::CONFIG);
        $commands = $this->getGeneratorCommands();

        if ($config['dto_class'] === null) {
            unset($commands['make-dto']);
        }

        return $commands;
    }

    private function getGeneratorCommands(): array
    {
        return [
            'make-dto' => MakeDtoCommand::class,
        ];
    }
}
