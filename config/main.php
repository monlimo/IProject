<?php
return [
    'template_root' => $_SERVER['DOCUMENT_ROOT'] . "/../views/",
    'layout' => 'main',
    'components' => [
        'user' => [
            'class' => "app\\models\\User"
        ],
        'auth' => [
            'class' => "app\\services\\Auth"
        ],
        'mainController' => [
            'class' => "app\\controllers\\FrontController"
        ],
        'request' => [
            'class' => "app\\services\\RequestManager",
            'rules' => [
                '#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?(?P<params>.*)#u'
            ]
        ],
        'bd' => [
            'class' => "app\\services\\Db",
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => '111'
        ],
        'db_remote' => [
            'class' => "app\\services\\Db",
            'driver' => 'mysql',
            'host' => '1.1.1.1',
            'login' => 'root',
            'password' => '',
            'database' => '111'
        ],
        'renderer' => [
            'class' => "app\\services\\TemplateRenderer"
        ]
    ],
];