<?php

namespace Elcomware\LocaleMaster;

use Elcomware\LocaleMaster\Commands\LocaleMasterCommand;
use Elcomware\LocaleMaster\Http\LocaleMiddleware;
use Elcomware\LocaleMaster\Models\Locale;
use Elcomware\LocaleMaster\Policies\LocalePolicy;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
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
            ->hasTranslations()
            ->hasMigration('create_localemaster_table')
            ->hasCommand(LocaleMasterCommand::class);
    }


    public function bootingPackage(): void
    {
        //parent::bootingPackage();

        Gate::policy(Locale::class, LocalePolicy::class);


        /** @var Router $router */
        $router = $this->app['router'];
        $router->prependMiddlewareToGroup(
                'web', LocaleMiddleware::class
            )->aliasMiddleware('locale', LocaleMiddleware::class);
    }
}
