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
//  -   Remover interesse de empresa;
//  -   Atualizar arquivo de currículo;
//  -   Remover currículo de usuário comum;
//  -   Buscar por meio de uma lista de interesses;
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
        'pattern' => '/login2',
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
        'callback' => Controller\CurriculumController::class . ':addCurriculum',
    ],
    [
        'pattern' => '/addInterests',
        'callback' => Controller\CurriculumController::class . ':addInterests',
    ],
    [
        'pattern' => '/deleteInterests',
        'callback' => Controller\CurriculumController::class . ':deleteInterests',
    ],
    [
        'pattern' => '/updateCurriculum',
        'callback' => Controller\CurriculumController::class . ':updateCurriculum',
    ],
    [
        'pattern' => '/removeCurriculum',
        'callback' => Controller\CurriculumController::class . ':removeCurriculum',
    ],
    [
        'pattern' => '/searchCurByInt',
        'callback' => Controller\CurriculumController::class . ':searchCurByInt',
    ],
    [
        'pattern' => '/searchCurByAllInt',
        'callback' => Controller\CurriculumController::class . ':searchCurByAllInt',
    ],
    [
        'pattern' => '/searchInt',
        'callback' => Controller\CurriculumController::class . ':searchInt',
    ],
];
