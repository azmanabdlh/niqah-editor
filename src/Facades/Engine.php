<?php

namespace NIQAHEditor\Facades;

use Illuminate\Support\Facades\Facade;
use VendorName\Skeleton\Skeleton;

/**
 * @see \NIQAHEditor\Engine
 */
class Engine extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Skeleton::class;
    }
}
