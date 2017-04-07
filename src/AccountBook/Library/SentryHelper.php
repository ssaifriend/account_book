<?php
declare(strict_types=1);

namespace AccountBook\Library;

use Raven_Client;
use Raven_ErrorHandler;

class SentryHelper
{
	/** @var Raven_Client */
	private static $client;

	public static function enable(string $dsn): void
	{
		self::$client = new Raven_Client($dsn);

		$error_handler = new Raven_ErrorHandler(self::$client);
		$error_handler->registerExceptionHandler();
		$error_handler->registerErrorHandler();
		$error_handler->registerShutdownFunction();
	}

	/**
	 * @param \Exception|\Throwable $e
	 *
	 * @return void
	 */
	public static function triggerException($e): void
	{
		if (self::$client === null) {
			return;
		}

		self::$client->captureException($e);
	}

	public static function triggerMessage(string $message): void
	{
		if (self::$client === null) {
			return;
		}

		self::$client->captureMessage($message);
	}
}
