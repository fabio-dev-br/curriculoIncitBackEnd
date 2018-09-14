<?php

// Base
use Tx\Mailer;
use Pheanstalk\Pheanstalk;

// Model
use IntecPhp\Model\Account;
use IntecPhp\Model\Contact;
    //Uses digitados para a nova aplicação
use IntecPhp\Model\Access;
use IntecPhp\Model\System;
use IntecPhp\Model\FileHandler;

// Middleware
use IntecPhp\Middleware\AuthenticationMiddleware;
use IntecPhp\Middleware\HttpMiddleware;
use IntecPhp\Controller\ContactController;

// Service
use IntecPhp\Service\DbHandler;
use IntecPhp\Service\JwtWrapper;

// Worker
use IntecPhp\Worker\EmailWorker;

// View
use IntecPhp\View\Layout;

// Entity
    //Uses digitados para a nova aplicação
use IntecPhp\Entity\Curriculum;
use IntecPhp\Entity\Interest;
use IntecPhp\Entity\RequestPassword;
use IntecPhp\Entity\User;
use IntecPhp\Entity\UserHability;

// Controller
    //Uses digitados para a nova aplicação
use IntecPhp\Controller\UserController;
use IntecPhp\Controller\CurriculumController;

// ----------------------------------------- Base

$dependencies[PDO::class] = function ($c) {
    $db = $c['settings']['db'];

    return new PDO(
        'mysql:host='.$db['host'].';dbname='.$db['db_name'].';charset=' . $db['charset'],
        $db['db_user'],
        $db['db_pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
};

$dependencies[Mailer::class] = $dependencies->factory(function($c) {
    $credentials = $c['settings']['mail']['credentials'];
    $txMailer = new Mailer();
    $txMailer
        ->setServer($credentials['smtp_server'], $credentials['smtp_port'],$credentials['ssl'])
        ->setAuth($credentials['auth_email'], $credentials['auth_pass']);

    return $txMailer;
});

$dependencies[Pheanstalk::class] = function ($c) {
    $settings = $c['settings']['pheanstalk'];
    return new Pheanstalk($settings['host'], $settings['port']);
};

// ----------------------------------------- /Base

// ----------------------------------------- Model

$dependencies[Account::class] = function ($c) {
    $jwt = $c[JwtWrapper::class];
    return new Account($jwt);
};

$dependencies[Contact::class] = function ($c) {
    $settings = $c['settings']['contact'];
    return new Contact($settings['toEmail']);
};

$dependencies[Access::class] = function ($c) {
    $user = $c[User::class];
    $requestPass = $c[RequestPassword::class];
    $tube = $c[Pheanstalk::class]->useTube($c['settings']['mail']['tube_name']);
    $account = $c[Account::class];
    return new Access($user, $requestPass, $tube, $account);
};

$dependencies[System::class] = function ($c) {
    $curriculum = $c[Curriculum::class];
    $user = $c[User::class];
    $userHability = $c[UserHability::class];
    $interest = $c[Interest::class];
    $tube = $c[Pheanstalk::class]->useTube($c['settings']['mail']['tube_name']);
    return new System($curriculum, $user, $userHability, $interest, $tube);
};

$dependencies[FileHandler::class] = function($c) {
    $path = $c['settings']['curriculumPath'];
    return new FileHandler($path);
};

// ----------------------------------------- /Model

// ----------------------------------------- Service

$dependencies[DbHandler::class] = function ($c) {
    $pdo = $c[PDO::class];
    return new DbHandler($pdo);
};

$dependencies[JwtWrapper::class] = function ($c) {
    $jwtSettings = $c['settings']['jwt'];
    return new JwtWrapper($jwtSettings['app_secret'], $jwtSettings['token_expires']);
};

// ----------------------------------------- /Service

// ----------------------------------------- Worker

$dependencies[EmailWorker::class] = function($c) {
    $messageConfig = $c['settings']['mail']['message'];
    $mailer = $c[Mailer::class];
    return new EmailWorker($mailer, $messageConfig);
};

// ----------------------------------------- /Worker

// ----------------------------------------- Controller

$dependencies[ContactController::class] = function($c) {
    $contact = $c[Contact::class];
    $emailProducer = $c[Pheanstalk::class];
    $emailProducer->useTube('email');
    return new ContactController($contact, $emailProducer);
};

$dependencies[UserController::class] = function($c) {
    $access = $c[Access::class];
    $account = $c[Account::class];
    return new UserController($access, $account);
};

$dependencies[CurriculumController::class] = function($c) {
    $system = $c[System::class];
    $account = $c[Account::class];
    $fileHandler = $c[FileHandler::class];
    return new CurriculumController($system, $account, $fileHandler);
};

// ----------------------------------------- /Controller

// ----------------------------------------- Middleware

$dependencies[AuthenticationMiddleware::class] = function ($c) {
    $layout = new Layout();
    $account = $c[Account::class];
    return new AuthenticationMiddleware($layout, $account);
};

$dependencies[HttpMiddleware::class] = function ($c) {
    $layout = new Layout();
    return new HttpMiddleware($layout, $c['settings']['display_errors']);
};


// ----------------------------------------- /Middleware

// ----------------------------------------- Entity

$dependencies[Curriculum::class] = function($c) {
    $conn = $c[DbHandler::class];
    return new Curriculum($conn);
};

$dependencies[Interest::class] = function($c) {
    $conn = $c[DbHandler::class];
    return new Interest($conn);
};

$dependencies[RequestPassword::class] = function($c) {
    $conn = $c[DbHandler::class];
    return new RequestPassword($conn);
};

$dependencies[User::class] = function($c) {
    $conn = $c[DbHandler::class];
    return new User($conn);
};

$dependencies[UserHability::class] = function($c) {
    $conn = $c[DbHandler::class];
    return new UserHability($conn);
};

// ----------------------------------------- /Entity