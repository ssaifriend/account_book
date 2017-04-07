<?php
declare(strict_types=1);

class ConfigDefault
{
	public const SENTRY_ENABLE = false;
	public const SENTRY_KEY = '';

	public const DB = [
		'default' => [
			'host' => 'localhost',
			'port' => 3306,
			'user' => '',
			'password' => '',
			'dbname' => '',
		]
	];
}

if (file_exists(__DIR__ . '/config.real.php')) {
	include_once __DIR__ . '/config.real.php';
} elseif (file_exists(__DIR__ . '/config.local.php')) {
	include_once __DIR__ . '/config.local.php';
} else {
	class Config extends ConfigDefault
	{
	}
}
