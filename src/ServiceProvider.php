<?php

namespace NIQAHEditor;


use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

use NIQAHEditor\Commands\SkeletonCommand;
use NIQAHEditor\View\Components\Hero;

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

    
    public function registeringPackage()
    {
        
        $this->app->bind(Engine::class, function () {
            return (new Engine())->adoptComponents($this->blockComponents());
        });
    }

    
    protected function blockComponents(): array
    {
        return [
            Hero::class,
        ];
    }

}



