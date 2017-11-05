<?php
declare(strict_types=1);

namespace AccountBook\Common;

class BaseDto
{
	/**
	 * @return static
	 */
	public static function importEmptyObject()
	{
		return new static;
	}
}
