<?php

namespace IntecPhp\Middleware;

use IntecPhp\View\Layout;
use IntecPhp\Model\Account;
use IntecPhp\Model\ResponseHandler;

class AuthenticationMiddleware
{
    private $layout;
    private $account;

    public function __construct(Layout $layout, Account $account)
    {
        $this->layout = $layout;
        $this->account = $account;
    }

    public function isAuthenticated($request)
    {
        if (!$this->account->isLoggedIn()) {
            if (!$request->isXmlHttpRequest()) {
                $this->layout
                    ->setLayout('layout-error')
                    ->render('http-error/403');
            } else {
                $rp = new ResponseHandler(403, 'Você não tem permissão para acessar este recurso');
                $rp->printJson();
            }
            exit;
        }
    }
}
