<?php

/*
 * Open Source
 */

namespace M1guelpf\Integration;

use Illuminate\Support\Facades\Facade;

/**
 * @see \M1guelpf\Integration
 */
class IntegrationFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'integration';
    }
}
