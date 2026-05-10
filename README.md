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
php artisan vendor:publish --tag="niqah-editor-config"
```

This is the contents of the published config file:

```php
return [
  // ...
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="niqah-editor-views"
```

## Usage

```php
<?php

use NIQAHEditor\Facades\Engine;
use NIQAHEditor\View\Components\Hero;


Engine::registerComponent(Hero::class);


Engine::editor('1.0.0')->toJSON();
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
//             "thumbnail": "example.com/hero.jpg"
//         }
//     ]
// }

```

Alternatively, you can retrieve active components from a specific Page in the database to be rendered in the editor.

```php
<?php

use App\Models\Page;


// example...
$activeComponents = Page::find(1)->blockComponents();

Engine::editor('1.0.0', $activeComponents)->toJSON();

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

- [Azman Abdlh](https://github.com/azmanabdlh)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
