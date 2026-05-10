<?php

namespace NIQAHEditor;


use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

use NIQAHEditor\Commands\SkeletonCommand;

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

    
    public function bootingPackage()
    {
        // TODO: Add Blade directive
        // Blade::directive('NIQAHeditor', function ($expression) {
            // return Facade::editor($version, $activeComponents)->render();
        // });
    }

}



