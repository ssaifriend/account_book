<?php
declare(strict_types=1);

namespace AccountBook\Common;

use AccountBook\Library\RedirectException;
use AccountBook\Library\SentryHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

abstract class BaseController
{
    /** @var Session */
    protected $session;
    /** @var Request */
    protected $request;

    public function __construct()
    {
        $this->initSession();

        $this->request = Request::createFromGlobals();

        $this->assertLogin();
    }

    private function initSession()
    {
        $this->session = new Session;

        try {
            $this->session->start();
        } catch (\Exception $e) {
            SentryHelper::triggerException($e);
        }
    }

    private function assertLogin()
    {
        $url = explode('/', $this->request->getRequestUri());
        $is_logged = $this->isLogin();
        if ($url[1] !== 'user' && !$is_logged) {
            throw new RedirectException('/user/login');
        } elseif ($url[1] === 'user' && $is_logged) {
            throw new RedirectException('/month');
        }
    }

    protected function isLogin(): bool
    {
        return $this->session->get('login') === true;
    }

    public function getExtendVariable(): array
    {
        return [
            'session' => $this->session->all(),
            'request_url' => explode('/', $this->request->getRequestUri()),
            'menus' => [
                'month' => '월별 데이터 조회',
                'data' => '자료 관리',
                'carmonth' => '연비 조회',
                'cardata' => '주유기록 관리',
                'config' => '설정',
            ]
        ];
    }
}
