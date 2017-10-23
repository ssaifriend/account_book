<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\Common\BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends BaseController
{
    public function index(): RedirectResponse
    {
        return new RedirectResponse('/user/login');
    }

	public function login(): array
	{
	    return [];
	}

	public function doLogin(): RedirectResponse
    {
        $password = $this->request->request->get('password');
        if ($password === \Config::PASSWORD) {
            $this->session->set('login', true);
            return new RedirectResponse('/month');
        } else {
            return new RedirectResponse('/user/login');
        }
    }
}
