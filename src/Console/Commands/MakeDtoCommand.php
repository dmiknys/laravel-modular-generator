<?php

namespace Dmiknys\LaravelModularGenerator\Console\Commands;

use Dmiknys\LaravelModularGenerator\Services\ModularGeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeDtoCommand extends ModularGeneratorCommand
{
    protected $signature = 'make:dto';
    protected $description = 'Create a DTO class';

    protected function getStub(): string
    {
        return $this->resolveStubPath('dto.stub');
    }

    protected function buildClass($name): string
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceDtoImport($stub, config('modular-generator.dto_class'))
            ->replaceDtoInheritance($stub, config('modular-generator.dto_class'))
            ->replaceClass($stub, $name);
    }

    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the resource already exists'],
            ['module', 'm', InputOption::VALUE_REQUIRED, 'Create a DTO in the specified module'],
        ];
    }

    protected function getEntityNamespace(): string
    {
        return 'Dtos';
    }

    private function replaceDtoImport(string &$stub, ?string $dtoClass): self
    {
        $stub = str_replace('{{ DTOImport }}', $dtoClass ? "\nuse $dtoClass;\n" : "", $stub);

        return $this;
    }

    private function replaceDtoInheritance(string &$stub, ?string $dtoClass): self
    {
        if (!$dtoClass) {
            return $this;
        }

        $stub = str_replace('{{ DTO }}', sprintf('extends %s', class_basename($dtoClass)), $stub);

        return $this;
    }
}