<?php

namespace Wedevlt\LaravelModularGenerator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wedevlt\LaravelModularGenerator\Skeleton\SkeletonClass
 */
class LaravelModularGeneratorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-modular-generator';
    }
}
