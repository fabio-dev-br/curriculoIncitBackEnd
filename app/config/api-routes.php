<?php

namespace IntecPhp;

use IntecPhp\View\Layout;
use IntecPhp\Middleware\AuthenticationMiddleware;

// Arquivo contendo as rotas para funcionalidades do site
// Funcionalidades existentes:
//  -   Criar nova conta;
//  -   Logar na plataforma;
//  -   Trocar a senha, pelo esqueci minha senha;
//  -   Adicionar novo currículo de usuário comum;
//  -   Adicionar novo interesse de empresa;
return [
    [
        'pattern' => '/contact',
        'callback' => Controller\ContactController::class . ':contact',
    ],
    [
        'pattern' => '/newAccount',
        'callback' => Controller\UserController::class . ':newAccount',
    ],
    [
        'pattern' => '/login',
        'callback' => Controller\UserController::class . ':login',
    ],
    [
        'pattern' => '/forgetMyPass',
        'callback' => Controller\UserController::class . ':forgetMyPass',
    ],
    [
        'pattern' => '/changeMyPass',
        'callback' => Controller\UserController::class . ':changeMyPass',
    ],
    [
        'pattern' => '/addCurriculum',
        'callback' => Controller\UserController::class . ':addCurriculum',
    ],
    [
        'pattern' => '/addInterests',
        'callback' => Controller\UserController::class . ':addInterests',
    ],
    [
        'pattern' => '/deleteInterest',
        'callback' => Controller\UserController::class . ':deleteInterest',
    ],
    [
        'pattern' => '/updateCurriculum',
        'callback' => Controller\UserController::class . ':updateCurriculum',
    ],
    [
        'pattern' => '/removeCurriculum',
        'callback' => Controller\UserController::class . ':removeCurriculum',
    ]
];
