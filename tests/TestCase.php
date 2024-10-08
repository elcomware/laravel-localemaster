<?php

namespace Elcomware\LocaleMaster\Tests;

use Elcomware\LocaleMaster\LocaleMasterServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Elcomware\\LocaleMaster\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Workbench\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

    }

    protected function getPackageProviders($app): array
    {
        return [
            LocaleMasterServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        Config::set('database.default', 'testing');

        //$migration = include __DIR__.'/../database/migrations/create_laravel-localemaster_table.php.stub';
        $migrationTest = include __DIR__.'/../database/migrations/create_test_table.php';
        $migration = include __DIR__.'/../database/migrations/create_localemaster_table.php';
        $migrationTest->up();
        $migration->up();

    }
}
