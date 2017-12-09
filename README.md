# A PHP class to interact with GitHub Apps

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m1guelpf/integration.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/integration)
[![Build Status](https://img.shields.io/travis/m1guelpf/integration/master.svg?style=flat-square)](https://travis-ci.org/m1guelpf/integration)
[![Quality Score](https://img.shields.io/scrutinizer/g/m1guelpf/integration.svg?style=flat-square)](https://scrutinizer-ci.com/g/m1guelpf/integration)
[![Total Downloads](https://img.shields.io/packagist/dt/m1guelpf/integration.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/integration)

This package makes it easy to interact with GitHub Apps by providing a wrapper around the GitHub API PHP Client.

## Installation


You can install the package via composer:

```bash
composer require m1guelpf/integration
```

## Usage

To get the authentication data, you have to define the following Laravel configuration keys:

You'll need the following data:
- Application ID: `config('github.application.id')`
- Application PEM file: `config('github.application.pem')`

``` php
$integration = new M1guelpf\Integration();
$integration->authenticate()
            ->asInstallation(1234)
            ->api('repo')
            ->show('example', 'repo');
```

### Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email soy@miguelpiedrafita.com instead of using the issue tracker.

## Credits

- [Miguel Piedrafita](https://github.com/m1guelpf)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
