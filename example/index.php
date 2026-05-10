<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;

use NIQAHEditor\View\Components\Hero;
use NIQAHEditor\ServiceProvider;
use NIQAHEditor\Engine;



$app = new Container();
Facade::setFacadeApplication($app);


$app->bind('niqah', function () {
    $engine = new Engine();
    $engine->registerComponent(Hero::class);
    return $engine;
});

$provider = new ServiceProvider($app);

$provider->register();
$provider->boot();


var_dump($app->make('niqah')->editor('1.0.0', '[]')?->toJSON());

// Engine::editor('1.0.0')->toJSON();
// Output
// {
//     "version": "1.0.0",
//     "activeComponents": [],
//     "blockComponents": [
//         {
//             "name": "Hero",
//             "description": "Bagian full-width di bagian atas situs yang berisi proposisi nilai (judul), deskripsi singkat, dan poin interaksi utama",
//             "blockComponent": {
//                 "id": "none",
//                 "node": "div",
//                 "type": "__Container",
//                 "attributes": [],
//                 "children": []
//             },
//             "thumbnail": ""
//         }
//     ]
// }


