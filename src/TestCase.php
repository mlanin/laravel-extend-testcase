<?php namespace Lanin\TestCase;

use Illuminate\Support\Str;
use PHPUnit_Framework_ExpectationFailedException as PHPUnitException;

class TestCase extends \Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * Needs to be implemented by subclasses.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../../../../bootstrap/app.php';

		$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}

	/**
	 * Find first user.
	 *
	 * @return \Illuminate\Contracts\Auth\Authenticatable|static
	 */
	protected function firstUser()
	{
		$class = '\\'.ltrim(config('auth.model'), '\\');

		return (new $class)->firstOrNew(['id' => 1]);
	}

	/**
	 * Act like the first user.
	 *
	 * @return $this
	 */
	protected function actingAsFirstUser()
	{
		$this->actingAs($this->firstUser(), env('AUTH_DRIVER'));

		return $this;
	}

    /**
     * Asserts that the response JSON contains the given path.
     *
     * @param  string $path
     * @return $this
	 * @throws PHPUnitException
     */
	protected function seeJsonMatchesPath($path)
	{
		$response = json_decode($this->response->getContent(), true);

		// Remove heading $. symbols
		$search = ltrim($path, '$.');

		// Using random string to protect against null values
		$notFoundString = Str::quickRandom(6);

		try {
			$this->assertNotEquals(
				array_get($response, $search, $notFoundString),
				$notFoundString
			);
		} catch (PHPUnitException $e) {
			throw new PHPUnitException("Unable to find provided path [{$path}] in received JSON [{$this->response->getContent()}].");
		}

		return $this;
	}

	/**
	 * Return value from the resulting JSON by path.
	 *
	 * @param $path
	 * @return mixed
	 */
	protected function getValueFromJsonByPath($path)
	{
		$response = json_decode($this->response->getContent(), true);

		// Remove heading $. symbols
		$search = ltrim($path, '$.');

		// Using random string to protect against null values
		$notFoundString = Str::quickRandom(6);

		try {
			$value = array_get($response, $search, $notFoundString);

			$this->assertNotEquals(
				$value,
				$notFoundString
			);
		} catch (PHPUnitException $e) {
			throw new PHPUnitException("Unable to find provided path [{$path}] in received JSON [{$this->response->getContent()}].");
		}

		return $value;
	}

	/**
     * Asserts that the response doesn't contain the given header.
     *
     * @param  string $headerName
     * @return $this
     */
    protected function dontSeeHeader($headerName)
    {
        $headers = $this->response->headers;

        $this->assertFalse($headers->has($headerName), "Header [{$headerName}] is present on response.");

        return $this;
    }

   	/**
     * Asserts that the response doesn't contain the given cookie.
     *
     * @param  string $cookieName
     * @return $this
     */
	protected function dontSeeCookie($cookieName)
	{
		$headers = $this->response->headers;

		$exist = false;
		foreach ($headers->getCookies() as $cookie) {
			if ($cookie->getName() === $cookieName) {
				$exist = true;
				break;
			}
		}

		$this->assertFalse($exist, "Cookie [{$cookieName}] was found.");

		return $this;
	}
}