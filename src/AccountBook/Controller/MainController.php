<?php
declare(strict_types=1);

namespace AccountBook\Controller;

use AccountBook\Common\BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MainController extends BaseController
{
    public function index(): RedirectResponse
    {
        return RedirectResponse::create('/user/login');
    }
}
