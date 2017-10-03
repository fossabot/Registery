# Registery

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](License.md)
[![Total Downloads][ico-downloads]][link-downloads]
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FDALTCORE%2FRegistery.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2FDALTCORE%2FRegistery?ref=badge_shield)


Registery Database for Laravel

## Install

Via Composer

``` bash
$ composer require daltcore/registery
```

In your `config/app.php` at Service Providers
``` php
DALTCORE\Registery\RegisteryServiceProvider::class,
```

In your `config/app.php` at Aliasses
``` php
'Registery' => DALTCORE\Registery\Facade::class,
```

## Usage
> This is just an example!

Create a directory in `app` called `Registeries`

Create a file called `Config.php` with the following contents:
```php
<?php

namespace App\Registeries;

use DALTCORE\Registery\Registery;

class Config extends Registery {
    
    /**
    * These properties are optional!
    */
    protected $engine = Registery::JSONDB; // Registery::MEMORYDB Registery::NULLDB
    protected $prefix = ''; // Prefix for the "keys"
    protected $table = 'configs'; // Table name
}
```

Now you can access the registery trough the `Config` class like:

```php
$config = Config::get();
dump($config);
```

You can fill via:
```php
$config->fill(['foo' => 'bar']);
dump($config);
$config->save();
```

or

```php
$config->foo = 'baz';
dump($config);
$config->save();
```

or

```php
$config->update(['foo' => 'bar']);
dump($config);
```

You can get the values like this:
```php
dump($config->foo); // baz
```

or

You can get the values like this:
```php
dump($config->get()); // array
```
If you discover any security related issues, please contact [Ramon Smit](https://github.com/ramonsmit).


## Credits

- [RamonSmit](https://github.com/RamonSmit)

## License

The MIT License (MIT). Please see [License File](License.md) for more information.

[ico-version]: https://img.shields.io/github/release/daltcore/registery.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/daltcore/registery.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/daltcore/registery
[link-downloads]: https://packagist.org/packages/daltcore/registery


[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FDALTCORE%2FRegistery.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2FDALTCORE%2FRegistery?ref=badge_large)