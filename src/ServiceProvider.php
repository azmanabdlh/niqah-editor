<?php

namespace NIQAHEditor;

use NIQAHEditor\Commands\SkeletonCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('niqah-editor')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(SkeletonCommand::class);
    }
}
