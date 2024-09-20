<?php

namespace Elcomware\LocaleMaster;

use Elcomware\LocaleMaster\Commands\LocaleMasterCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LocaleMasterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-localemaster')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-localemaster_table')
            ->hasCommand(LocaleMasterCommand::class);
    }
}
