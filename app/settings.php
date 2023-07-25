<?php

declare(strict_types = 1);

use DI\Container;
use Monolog\Logger;

return function(Container $container){

    $container ->set ('settings',function(){
        return[
            'name'=>'Test Slim App',
            'displayErrorDetails'=>true,
            'logErrorDetails'=>true,
            'logError'=>true,
            'logger'=>[
                'name'=>'slim-app',
                'path'=>__DIR__ . '/../logs/app.log',
                'level'=>Logger::DEBUG,
            ],   
             'views' =>[
                'path'=> __DIR__ . '/../src/views',
                'settings'=>['cache'=>false],
            ],'connection' =>[
                'host'=>'slimapp4-db-1',
                'dbname'=>'db',
                'dbuser'=>'user',
                'dbpass'=>'secret'
            ]
        ];

    });

};