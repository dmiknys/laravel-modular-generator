<?php

namespace Dmiknys\LaravelModularGenerator\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeDtoCommand extends GeneratorCommand
{
    protected $signature = 'make:dto {name} {--module=}';
    protected $description = 'Creates DTO class';

    protected function getDefaultNamespace($rootNamespace): string
    {
        return parent::getDefaultNamespace($this->getModuledNamespace($rootNamespace));
    }

    protected function getStub(): string
    {
        return __DIR__ . '/../../../stubs/dto.stub';
    }

    private function getModuledNamespace(string $rootNamespace): string
    {
        $module = $this->option('module');

        return $module
            ? config('modular-generator.namespace', $rootNamespace) . '\\' . $module . '\\Dtos'
            : config('modular-generator.namespace', $rootNamespace) . '\\Dtos';
    }
}