<?php

namespace NIQAHEditor;


use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

use NIQAHEditor\Commands\SkeletonCommand;
use NIQAHEditor\View\Components\Hero;
use Override;

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
            ->name('niqah_editor')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoutes('web')
            ->hasCommand(SkeletonCommand::class);
    }


    #[Override]
    public function registeringPackage()
    {        
        $this->app->singleton("niqah-editor", function () {
            $niqah = new Engine();
            $niqah->adoptComponents($this->blockComponents());

            return $niqah;
        });
    }

    
    protected function blockComponents(): array
    {
        return [
            Hero::class,
        ];
    }
}



