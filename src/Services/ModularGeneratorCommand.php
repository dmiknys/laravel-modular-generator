<?php

namespace Wedevlt\LaravelModularGenerator\Services;

use Illuminate\Console\GeneratorCommand;

abstract class ModularGeneratorCommand extends GeneratorCommand
{
    protected function getStub(): string
    {
        return '';
    }

    protected function getConfig(): string
    {
        return config('modular-generator');
    }

    abstract protected function getEntityNamespace(): string;

    protected function getDefaultNamespace($rootNamespace): string
    {
        return parent::getDefaultNamespace($this->getModuledNamespace($rootNamespace));
    }

    private function getModuledNamespace(string $rootNamespace): string
    {
        $parts = [
            config('modular-generator.namespace', $rootNamespace),
            $this->option('module'),
            $this->getEntityNamespace(),
        ];
        
        dd(implode('\\', array_filter($parts)));

        return $module
            ? config('modular-generator.namespace', $rootNamespace) . '\\' . $module . '\\Dtos'
            : config('modular-generator.namespace', $rootNamespace) . '\\Dtos';
    }
}