# Laravel-Extend-TestCase
> Add more functionality to default Laravel 5.1 TestCase. 

## Installation

[PHP](https://php.net) 5.5.9+ or [HHVM](http://hhvm.com) 3.3+, [Composer](https://getcomposer.org) and [Laravel](http://laravel.com) 5.1+ are required.

To get the latest version of Laravel-Extend-TestCase, simply add the following line to the require block of your `composer.json` file.

```
"lanin/laravel-extend-testcase": "dev-master"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once it was installed you don't have to register any ServiceProvider, Facade or publish any configs.

All you have to do is to extend your base Seeder class with `\Lanin\TestCase\TestCase` and you are ready to test!

```php
class TestCase extends \Lanin\TestCase\TestCase
```

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.
