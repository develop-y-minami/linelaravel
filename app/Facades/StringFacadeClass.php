<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * StringFacadeClass
 * 
 */
class StringFacadeClass extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'StringFacade';
    }
}