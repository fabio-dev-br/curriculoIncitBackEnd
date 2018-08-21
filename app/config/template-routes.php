<?php

namespace IntecPhp;

return [
    // [
    //     'pattern' => '/',
    //     'callback' => function() {
    //         $layout = new View\Layout();
    //         $layout
    //             ->addStylesheet('/css/home.min.css')
    //             ->addScript('/js/home.min.js')
    //             ->render('home/index');
    //     }
    // ],
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
];
