<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\Common\BaseController;

class UserController extends BaseController
{
	public function test()
	{
		return [
			'test' => 1234
		];
	}
}
