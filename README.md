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

## API

```php
/**
 * Fin or create first user (id => 1).
 *
 * @return \Illuminate\Contracts\Auth\Authenticatable|static
 */
protected function firstUser();

/**
 * Act like the first user.
 *
 * @return $this
 */
protected function actingAsFirstUser();

/**
 * Asserts that the response JSON contains the given path.
 * Example: $this->seeJsonMatchesPath('$.user.email');
 *
 * @param  string $path
 * @return $this
 * @throws PHPUnitException
 */
protected function seeJsonMatchesPath($path);

/**
 * Return value from the resulting JSON by path.
 * Example: $email = $this->getValueFromJsonByPath('$.user.email');
 *
 * @param  string  $path
 * @return mixed
 */
protected function getValueFromJsonByPath($path);

/**
 * Asserts that the response doesn't contain the given header.
 *
 * @param  string $headerName
 * @return $this
 */
protected function dontSeeHeader($headerName);

/**
 * Asserts that the response doesn't contain the given cookie.
 *
 * @param  string $cookieName
 * @return $this
 */
protected function dontSeeCookie($cookieName);
```

## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.
