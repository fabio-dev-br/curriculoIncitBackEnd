<?php

namespace IntecPhp;

use IntecPhp\View\Layout;
use IntecPhp\Middleware\AuthenticationMiddleware;

return [
    [
        'pattern' => '/contact',
        'callback' => Controller\ContactController::class . ':contact',
    ],
    [
        'pattern' => '/newAccount',
        'callback' => Controller\UserController::class . ':newAccount',
    ]
];
