<?php

namespace Dmiknys\LaravelModularGenerator\Console\Commands;

use Dmiknys\LaravelModularGenerator\Services\ModularGeneratorCommand;
use Illuminate\Foundation\Console\RequestMakeCommand;
use Symfony\Component\Console\Input\InputOption;

// TODO: Figure out how to use illuminate/foundation/Console/RequestMakeCommand instead of this
class MakeRequestCommand extends ModularGeneratorCommand
{
    protected $name = 'make:request';
    protected $description = 'Create a new form request class';
    protected $type = 'Request';

    protected function getStub(): string
    {
        return $this->resolveStubPath('request.stub');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['module', 'm', InputOption::VALUE_REQUIRED, 'Create a resource in the specified module'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the request already exists'],
        ];
    }

    protected function getEntityNamespace(): string
    {
        return 'Requests';
    }

    protected function buildClass($name): string
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceDtoImport($stub, config('modular-generator.abstract_request'))
            ->replaceDto($stub, $this->option('module'))
            ->replaceClass($stub, $name);
    }

    private function replaceDtoImport(string &$stub, ?string $module): self
    {
    }

    private function replaceDto(string &$stub, ?string $class): self
    {
        $stub = str_replace('{{ RequestImport }}', $class ? "\nuse $class;\n" : "", $stub);

        return $this;
    }
}