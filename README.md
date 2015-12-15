# Qandidate Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

This is a service provider for [Qandidate](https://github.com/qandidate-labs/qandidate-toggle) package

## Install

Via Composer

``` bash
$ composer require msamec/qandidate-laravel
```
Register service provider in your `app.php`
```
'Msamec\QandidateLaravel\QandidateLaravelServiceProvider',
```
Register the facade in your `app.php`
```
'Qandidate' => 'Msamec\QandidateLaravel\QandidateFacade',
```

## Usage

``` php
Qandidate::active($featureName, $attributes);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Marko Šamec][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/:vendor/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/:vendor/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/:vendor/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/:vendor/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/:vendor/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/msamec/qandidate-laravel
[link-downloads]: https://packagist.org/packages/msamec/qandidate-laravel
[link-author]: https://github.com/msamec
[link-contributors]: ../../contributors
