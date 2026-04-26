<?php

namespace CodeWithDiki\ProductModule\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CodeWithDiki\ProductModule\Skeleton
 */
class ProductModule extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CodeWithDiki\ProductModule\ProductModule::class;
    }
}
