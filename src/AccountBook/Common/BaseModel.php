<?php
declare(strict_types=1);

namespace AccountBook\Common;

use Gnf\db\PDO;

class BaseModel
{
	/** @var PDO $db */
	protected $db;

	private function __construct(PDO $pdo)
	{
		$this->db = $pdo;
	}

	public static function create()
	{
		return new static(self::getConnection('default'));
	}

	private static function getConnection(string $key)
	{
		if (!array_key_exists($key, \Config::DB)) {
			throw new \Exception('Not exists db connection config: ' . $key);
		}

		$connection = \Config::DB[$key];
		$dsn = 'mysql:host=' . $connection['host'].';port=' . $connection['port'] . ';dbname=' . $connection['dbname'];
		$pdo = new \PDO($dsn, $connection['user'], $connection['password']);

		return new PDO($pdo);
	}
}
