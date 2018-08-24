<?php

namespace IntecPhp;

return [
    [
        'pattern' => '/',
        'callback' => function() {
            $layout = new View\Layout();
            $layout
                ->addStylesheet('/css/home.min.css')
                ->addScript('/js/homeCurriculo.min.js')
                ->render('homeCurriculo/index');
        }
    ],
    [
        'pattern' => '/login',
        'callback' => function() {
            $layout = new View\Layout('layout-login');
            $layout
                ->addStylesheet('/css/home.min.css')
                ->addScript('/js/loginCurriculo.min.js')
                ->render('loginCurriculo/index');
        }
    ],
    [
        'pattern' => '/portalPessoa',
        'callback' => function() {
            $layout = new View\Layout('layout-login');
            $layout
                ->addStylesheet('/css/home.min.css')
                ->addScript('/js/portalPessoaCurriculo.min.js')
                ->render('portalPessoaCurriculo/index');
        }
    ],
    [
        'pattern' => '/portalEmpresa',
        'callback' => function() {
            $layout = new View\Layout('layout-login');
            $layout
                ->addStylesheet('/css/home.min.css')
                //->addScript('/js/loginCurriculo.min.js')
                ->render('portalEmpresaCurriculo/index');
        }
    ]
];
