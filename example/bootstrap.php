<?php

use Illuminate\Config\Repository;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\Factory;
use Illuminate\View\ViewServiceProvider;
use NIQAHEditor\Engine;
use NIQAHEditor\ServiceProvider;
use NIQAHEditor\View\Components\Hero;

$app = new Application(realpath(__DIR__.'/..'));
Facade::setFacadeApplication($app);

$app->singleton('files', function () {
    return new Filesystem;
});

$app->singleton('config', function () {
    return new Repository([
        'view' => [
            'paths' => [
                realpath(__DIR__.'/../resources/views'),
            ],
            'compiled' => realpath(__DIR__.'/../storage/framework/views'),
        ],
    ]);
});

$app->alias('view', Factory::class);

$app->singleton('blade.compiler', function () use ($app) {
    return new BladeCompiler(
        $app['files'],
        $app['config']['view.compiled']
    );
});

$app->bind('Illuminate\View\ComponentAttributeBag', function () {
    return new ComponentAttributeBag;
});

$app->register(EventServiceProvider::class);
$app->register(ViewServiceProvider::class);

$app->bind('niqah', function () {
    $engine = new Engine;
    $engine->registerComponent(Hero::class);

    return $engine;
});

$provider = new ServiceProvider($app);

$provider->register();
$provider->boot();
