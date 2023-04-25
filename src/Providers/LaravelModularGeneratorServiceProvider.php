<?php

namespace Dmiknys\LaravelModularGenerator\Providers;

use Dmiknys\LaravelModularGenerator\Console\Commands\MakeDtoCommand;
use Illuminate\Support\ServiceProvider;

class LaravelModularGeneratorServiceProvider extends ServiceProvider
{
    public const CONFIG = 'modular-generator';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path(sprintf('%s.php', self::CONFIG)),
            ], 'config');

            $this->commands($this->getCommands());
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', self::CONFIG);
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
