<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => true,
                'logErrorDetails'     => true,
                'logger' => [
                    'name' => 'slim-app',
                    'path' =>  __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'views' =>[
                    'path'=> __DIR__ . '/../src/views',
                    'settings'=>['cache'=>false],
                ]
            ]);
        }
    ]);
};
