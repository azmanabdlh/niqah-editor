<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/bootstrap.php';

var_dump($app->make('niqah')->editor('1.0.0', '[]')?->toJSON());
// or
// echo $app->make('niqah')->editor('1.0.0', '[]')?->render()->toHTML();

// Engine::editor('1.0.0')->toJSON();
// Output
// {
//     "version": "1.0.0",
//     "activeComponents": [],
//     "blockComponents": [
//         {
//             "name": "Hero",
//             "__ClassName": "/NIQAHEditor/View/Components/Hero",
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
