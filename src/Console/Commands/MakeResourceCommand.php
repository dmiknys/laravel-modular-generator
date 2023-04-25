<?php

namespace Dmiknys\LaravelModularGenerator\Console\Commands;

use Dmiknys\LaravelModularGenerator\Services\ModularGeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

// TODO: Figure out how to use illuminate/foundation/Console/ResourceMakeCommand instead of this
class MakeResourceCommand extends ModularGeneratorCommand
{
    protected $name = 'make:resource';
    protected $description = 'Create a new resource';
    protected $type = 'Resource';

    public function handle()
    {
        if ($this->collection()) {
            $this->type = 'Resource collection';
        }

        parent::handle();
    }

    protected function getStub(): string
    {
        return $this->collection()
            ? $this->resolveStubPath('resource-collection.stub')
            : $this->resolveStubPath('resource.stub');
    }

    protected function collection(): bool
    {
        return $this->option('collection') ||
            str_ends_with($this->argument('name'), 'Collection');
    }

    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the resource already exists'],
            ['collection', 'c', InputOption::VALUE_NONE, 'Create a resource collection'],
            ['module', 'm', InputOption::VALUE_REQUIRED, 'Create a resource in the specified module'],
        ];
    }

    protected function getEntityNamespace(): string
    {
        return 'Resources';
    }
}