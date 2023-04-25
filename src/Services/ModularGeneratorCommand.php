<?php

namespace Dmiknys\LaravelModularGenerator\Services;

use Illuminate\Console\GeneratorCommand;

abstract class ModularGeneratorCommand extends GeneratorCommand
{
    protected function getStub(): string
    {
        return '';
    }

    abstract protected function getEntityNamespace(): string;

    protected function getDefaultNamespace($rootNamespace): string
    {
        return parent::getDefaultNamespace($this->getModuledNamespace($rootNamespace));
    }

    protected function resolveStubPath(string $stub): string
    {
        return __DIR__ . '/../../stubs/' . $stub;
    }

    private function getModuledNamespace(string $rootNamespace): string
    {
        $parts = [
            config('modular-generator.namespace', $rootNamespace),
            $this->option('module'),
            $this->getEntityNamespace(),
        ];

        return implode('\\', array_filter($parts));
    }
}