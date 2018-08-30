<?php

// as chaves iguais serão sobrescritas pelo array em settings.local.php

return [
    'display_errors' => true,
    'db' => [
        'host' => getenv('DB_HOST'),
        'db_name' => getenv('DB_NAME'),
        'db_user' => getenv('DB_USER'),
        'db_pass' => getenv('DB_PASS'),
        'charset' => 'utf8mb4'
    ],
    'jwt' => [
        'app_secret' => getenv('APP_SECRET'),
        'token_expires' => 1800 // 30 min
    ],
    'session' => [
        'cookie_name' => getenv('APP_COOKIE_NAME'),
        'cookie_expires' => 1800 // 30 min
    ],
    'pheanstalk' => [
        'host' => getenv('BEANSTALK_HOST'),
        'port' => 11300
    ],
    'contact' => [
        'toEmail' => ''
    ],
    'mail' => [
        'tube_name' => 'phpstart_email',
        'credentials' => [
            'smtp_server' => '',
            'smtp_port' => '',
            'ssl' => 'tls',
            'auth_email' => '',
            'auth_pass' => '',
        ],
        'message' => [
            'subject_prefix' => 'Incluir Tecnologia ',
            'default_from' => 'suporte@incluirtecnologia.com.br',
            'default_from_name' => 'Suporte',
            'default_bcc' => false,
        ]
    ],
    'curriculumPath' => 'public/curriculos'
];
