<?php

/*
 * Open Source
 */

namespace M1guelpf\Integration;

use Illuminate\Support\ServiceProvider;
use M1guelpf\Integration as IntegrationClass;

class IntegrationServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('integration', IntegrationClass::class);
    }
}
