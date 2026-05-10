<?php

namespace NIQAHEditor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NIQAHEditor\Engine
 */
class Engine extends Facade
{    
    protected static function getFacadeAccessor(): string
    {
        return "niqah-editor";
    }
}
