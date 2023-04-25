<?php

namespace Dmiknys\LaravelModularGenerator\Console\Commands;

use Wedevlt\LaravelModularGenerator\Services\ModularGeneratorCommand;

class MakeDtoCommand extends ModularGeneratorCommand
{
    protected $signature = 'make:dto {name} {--module=}';
    protected $description = 'Creates DTO class';

    protected function getStub(): string
    {
        return __DIR__ . '/../../../stubs/dto.stub';
    }

    protected function getEntityNamespace(): string
    {
        return 'Dtos';
    }
}