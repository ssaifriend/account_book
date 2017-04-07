<?php
declare(strict_types=1);

namespace AccountBook\Common;

class BaseDto
{
	/**
	 * @return BaseDto
	 */
	public static function importEmptyObject()
	{
		return new static;
	}
}
