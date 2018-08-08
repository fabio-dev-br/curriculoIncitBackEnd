<?php

namespace IntecPhp;

use IntecPhp\View\Layout;
use IntecPhp\Middleware\AuthenticationMiddleware;

return [
    [
        'pattern' => '/validator',
        'callback' => function () {
            $layout = new Layout();
            $layout->render('home/validator');
        },
    ],
    [
        'pattern' => '/ajax-form',
        'callback' => function () {
            $layout = new Layout();
            $layout
                ->render('home/ajax-form');
        }
    ],
    [
        'pattern' => '/ajax-form-submit',
        'callback' => function () {
            http_response_code(404);
            echo json_encode([
                'errorMessage' => 'O recurso solicitado não está mais disponível',
            ]);
        }
    ],
    // docs routes
    [
        'pattern' => '/docs',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout
                ->addStylesheet('/css/docs.min.css')
                ->render('docs/index');
        }
    ],
    [
        'pattern' => '/docs/php',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/php');
        }
    ],
    [
        'pattern' => '/docs/composer',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/composer');
        }
    ],
    [
        'pattern' => '/docs/beanstalk',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/beanstalk');
        }
    ],
    [
        'pattern' => '/docs/redis',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/redis');
        }
    ],
    [
        'pattern' => '/docs/npm',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/npm');
        }
    ],
    [
        'pattern' => '/docs/mysql',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/mysql');
        }
    ],
    [
        'pattern' => '/docs/grunt',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/grunt');
        }
    ],
    [
        'pattern' => '/docs/pm2',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/pm2');
        }
    ],
    [
        'pattern' => '/docs/sass',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/sass');
        }
    ],
    [
        'pattern' => '/docs/bootstrap',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout->render('docs/bootstrap');
        },
    ],
    [
        'pattern' => '/docs/icons',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout
                ->addStylesheet('/css/icons.min.css')
                ->render('docs/icons');
        }
    ],
    [
        'pattern' => '/docs/vue',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout
                ->addScript('/js/docs-vue.min.js')
                ->render('docs/vue');
        }
    ],
    [
        'pattern' => '/docs/vue/loadData',
        'callback' => function () {
            $trips = [];
            for ($i = 0; $i < 4; $i++) {
                $trips[] = [
                    'id' => $i,
                    'imgSrc' => '/img/portfolio/escape-preview.png',
                    'imgAlt' => 'Uma viagem ' . $i,
                    'title' => 'Uma viagem feliz! ' . $i,
                    'comment' => 'Este é o texto de comentário da imagem ...' . $i
                ];
            }

            $rp = new Model\ResponseHandler(200, 'ok', $trips);

            return $rp->printJson();
        }
    ],
    [
        'pattern' => '/docs/vue-masks-and-filters',
        'callback' => function () {
            $layout = new Layout('layout-docs');
            $layout
                ->addScript('/js/docs-filter-mask.min.js')
                ->render('docs/vue-masks-and-filters');
        }
    ],
    [
        'pattern' => '/error-403',
        'middlewares' => [
            AuthenticationMiddleware::class .':isAuthenticated',
        ],
        'callback' => function () {
        }
    ],
    [
        'pattern' => '/error-500',
        'callback' => function ($request) {
            throw new \Error('Simulação de um erro', 1);
        }
    ],
];
