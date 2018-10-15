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
        'token_expires' => 1728000 // 2 dias
    ],
    'session' => [
        'cookie_name' => getenv('APP_COOKIE_NAME'),
        'cookie_expires' => 172800 // 2 dias
    ],
    'pheanstalk' => [
        'host' => getenv('BEANSTALK_HOST'),
        'port' => 11300
    ],
    'contact' => [
        'toEmail' => ''
    ],
    'mail' => [
        'tube_name' => 'curriculum_email',
        'credentials' => [
            'smtp_server' => 'mail2.incluirtecnologia.com.br',
            'smtp_port' => '25',
            'ssl' => 'tls',
            'auth_email' => 'incit.curriculos@incluirtecnologia.com.br',
            'auth_pass' => 'incit123456',
        ],
        'message' => [
            'subject_prefix' => '',
            'default_from' => 'incit.curriculos@incluirtecnologia.com.br',
            'default_from_name' => 'Incit Currículo',
            'default_bcc' => false,
        ]
    ],
    'curriculumPath' => 'public/curriculos/'
];
