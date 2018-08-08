<?php

namespace IntecPhp\Middleware;

use IntecPhp\View\Layout;
use IntecPhp\Model\Config;
use IntecPhp\Model\ResponseHandler;

class HttpMiddleware
{
    private $layout;
    private $displayErrors;

    public function __construct(Layout $layout, bool $displayErrors)
    {
        $this->layout = $layout;
        $this->displayErrors = $displayErrors;
    }

    public function pageNotFound($request)
    {
        http_response_code(404);
        if ($request->isXmlHttpRequest()) {
            $rp = new ResponseHandler(404, 'Página não encontrada.');
            $rp->printJson();
        } else {
            $this->layout
                ->setLayout('layout-error')
                ->render('http-error/404');
        }
        exit;
    }

    public function fatalError($request, $err)
    {
        if ($request->isXmlHttpRequest()) {
            $err = $this->displayErrors ? [
                'message' => $err->getMessage(),
                'code' => $err->getCode(),
                'file' => $err->getFile(),
                'line' => $err->getLine()
            ] : [];

            $rp = new ResponseHandler(500, 'Ops! Houve um problema inesperado.', $err);
            $rp->printJson();
        } else {
            $this->layout
                    ->setLayout('layout-error')
                    ->render('http-error/500', ['e' => $err, 'displayErrors' => $this->displayErrors]);
        }
        exit;
    }
}
