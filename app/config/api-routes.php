<?php

namespace IntecPhp;

use IntecPhp\View\Layout;
use IntecPhp\Middleware\AuthenticationMiddleware;

// Arquivo contendo as rotas para funcionalidades do site
// Funcionalidades existentes:
//  -   Verificar se e-mail já existe
//  -   Criar nova conta;
//  -   Logar na plataforma;
//  -   Trocar a senha, pelo esqueci minha senha;
//  -   Adicionar novo currículo de usuário comum;
//  -   Adicionar novo interesse de empresa;
//  -   Remover interesse de empresa;
//  -   Atualizar arquivo de currículo;
//  -   Remover currículo de usuário comum;
//  -   Buscar currículo por meio de uma lista de interesses;
//  -   Buscar interesses de um usuário empresa;
//  -   Buscar o currículo de um usuário;
return [
    [
        'pattern' => '/contact',
        'callback' => Controller\ContactController::class . ':contact',
    ],
    [
        'pattern' => '/isEmailUnique',
        'callback' => Controller\UserController::class . ':isEmailUnique',
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
        'pattern' => '/forgotMyPass',
        'callback' => Controller\UserController::class . ':forgotMyPass',
    ],
    [
        'pattern' => '/verifyHashChangePass',
        'callback' => Controller\UserController::class . ':verifyHashChangePass',
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
    [
        'pattern' => '/getCurriculum',
        'callback' => Controller\CurriculumController::class . ':getCurriculum',
    ],
];
