<?php

use NIQAHEditor\Facades\Engine;
use NIQAHEditor\View\Components\Hero;

Engine::registerComponent(new Hero());



Engine::editor('1.0.0')->toJSON();
// [
//   'version' => '1.0.0',
//   'activeComponents' => [],
//   'blockComponents' => [
//     'hero' => [
//       'name' => 'hero',
//       'node' => 'div',
//       'type' => '__Container',
//       'children' => [],
//     ] 
//   ]
// ]


Engine::editor('1.0.0')->render();
// blade template...
// ....

