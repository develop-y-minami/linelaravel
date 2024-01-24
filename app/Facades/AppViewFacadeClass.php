<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * AppViewFacadeClass
 * 
 */
class AppViewFacadeClass extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'AppViewFacade';
    }
}