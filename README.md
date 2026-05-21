# NIQAH Editor
![cover.png](cover.png)

NIQAH editor is a Laravel package that serves as the architectural foundation for the NIQAH dynamic page editor ecosystem. Designed for specific internal business purposes, it provides a flexible engine for managing modular block components.

## Installation

You can install the package via composer:

```bash
composer require azmanabdlh/niqah-editor
```


You can publish the config file with:

```bash
php artisan vendor:publish --tag="niqah_editor-config"
```

This is the contents of the published config file:

```php
<?php
return [
    'middleware' => ['web'],

    'blocks' => [
        'threshold' => 30,
    ],
];

```

You can publish and run the migrations with:
```php
php artisan vendor:publish --tag="niqah_editor-migrations"
php artisan migrate
```


## Usage

```php
<?php

use NIQAHEditor\Facades\Engine;
use NIQAHEditor\View\Components\Hero;
use NIQAHEditor\Models\BlockComponent;

Engine::registerComponent(new Hero());
// or
Engine::adoptComponents(
  BlockComponent::all()->asComponent()
);

Engine::editor('1.0.0', activeComponent: '[]')->toJSON();
// Output
// {
//     "version": "1.0.0",
//     "activeComponents": [],
//     "blockComponents": [
//         {
//             "name": "Hero",
//             "description": "example..",
//             "blockComponent": {
//                 "id": "none",
//                 "node": "div",
//                 "type": "__Container",
//                 "props": [],
//                 "children": []
//             },
//             "thumbnail": "example.com/hero.jpg"
//         }
//     ]
// }
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.


## Credits
![logo.png](logo.png)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
