<?php

namespace M1guelpf\Integration\Test;

use Orchestra\Testbench\TestCase as Orchestra;
use M1guelpf\Integration\IntegrationServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [IntegrationServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('github.application.id', 1633); // note: this is dummy data
        $app['config']->set('github.application.pem', file_get_contents(__DIR__.'/stubs/test.pem')); // note: this is dummy data
    }
}
