<?php

namespace Nickolaich\NovaPortfolio\Tests;

abstract class IntegrationTest extends \Orchestra\Testbench\TestCase
{

    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->loadMigrations();
        //$this->withFactories(__DIR__.'/Factories');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Load the migrations for the test environment.
     *
     * @return void
     */
    protected function loadMigrations()
    {
        $this->loadMigrationsFrom([
            '--database' => 'sqlite',
            '--realpath' => realpath(__DIR__ . '/Migrations'),
        ]);
    }
}

