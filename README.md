# NIQAH Editor
![cover.png](cover.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)

[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/:vendor_slug/:package_slug/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/:vendor_slug/:package_slug/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/:vendor_slug/:package_slug.svg?style=flat-square)](https://packagist.org/packages/:vendor_slug/:package_slug)
<!--delete-->
---

niqah-editor is a Laravel package that serves as the "Engine editor by NIQAH". This package is designed as a page-builder or component editor engine for Laravel and NIQAH internal platforms, allowing for the dynamic  management of block components.


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
