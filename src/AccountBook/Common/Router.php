<?php
declare(strict_types=1);

namespace AccountBook\Common;

use AccountBook\Library\SentryHelper;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class Router
{
	public static function run()
	{
		$app = new Application();

		self::init($app);

		$app->match(
			'/',
			function () use ($app) {
				return self::doProcess($app, 'main', 'index');
			}
		);

		$app->match(
			'/{controller}',
			function (string $controller) use ($app) {
				return self::doProcess($app, $controller, 'index');
			}
		);

		$app->match(
			'/{controller}/{method}',
			function (string $controller, string $method) use ($app) {
				return self::doProcess($app, $controller, $method);
			}
		);

		$app->run();
	}

	private static function init(Application $app)
	{
		$config = ['twig.path' => __DIR__ . '/../../../views'];
		$app->register(new TwigServiceProvider(), $config);

		if (\Config::SENTRY_ENABLE) {
			SentryHelper::enable(\Config::SENTRY_KEY);
		}
	}

	private static function doProcess(Application $app, string $controller_name, string $method)
	{
		$controller_namespace = 'AccountBook\\Controller\\';
		$controller_class_name = $controller_namespace . ucfirst($controller_name) . 'Controller';

		if (class_exists($controller_class_name)) {
			/** @var BaseController $controller_instance */
			$controller_instance = new $controller_class_name;
			$response = $controller_instance->{$method}();
		} else {
			$response = new Response('', 404);
		}

		if (is_array($response) || is_string($response)) {
			$twig_path = $controller_name . '/' . $method . '.twig';
			try {
				$result = $app['twig']->render($twig_path, $response);
			} catch (\Exception $e) {
				SentryHelper::triggerException($e);
				$result = new Response('', 500);
			}
		} else {
			$result = $response;
		}

		return $result;
	}
}
