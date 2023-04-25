<?php

namespace Dmiknys\LaravelModularGenerator\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeDtoCommand extends GeneratorCommand
{
    protected $signature = 'make:dto';
    protected $description = 'Creates DTO class';

    protected function getStub()
    {
        return '/../../../stubs/dto.stub';
    }
}