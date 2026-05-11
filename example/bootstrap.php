<?php

use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Events\EventServiceProvider;
use Illuminate\View\ComponentAttributeBag;


use NIQAHEditor\View\Components\Hero;
use NIQAHEditor\ServiceProvider;
use NIQAHEditor\Engine;



$app = new Application(realpath(__DIR__ . '/..'));
Facade::setFacadeApplication($app);


$app->singleton('files', function () {
    return new Filesystem();
});


$app->singleton('config', function () {
    return new Repository([
        'view' => [
            'paths' => [
                realpath(__DIR__ . '/../resources/views')
            ],
            'compiled' => realpath(__DIR__ . '/../storage/framework/views')
        ],
    ]);
});


$app->alias('view', \Illuminate\View\Factory::class);

$app->singleton('blade.compiler', function () use ($app) {
    return new \Illuminate\View\Compilers\BladeCompiler(
        $app['files'], 
        $app['config']['view.compiled']
    );
});


$app->bind('Illuminate\View\ComponentAttributeBag', function () {
    return new ComponentAttributeBag();
});


$app->register(EventServiceProvider::class);
$app->register(ViewServiceProvider::class);


$app->bind('niqah', function () {
    $engine = new Engine();
    $engine->registerComponent(Hero::class);
    return $engine;
});

$provider = new ServiceProvider($app);

$provider->register();
$provider->boot();
