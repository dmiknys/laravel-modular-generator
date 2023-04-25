<?php

return [
    'namespace' => 'App\\Modules',

    'strict_types' => true, // coming soon

    // Provide dto class name to use it as a base class for all generated DTOs
    // (e.g. \Spatie\LaravelData\Data::class)
    // if null, command will not extend any class
    'dto_class' => null,
];