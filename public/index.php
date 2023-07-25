<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use DI\Container;

require  __DIR__ . '/../vendor/autoload.php';

$container = new Container();

AppFactory::setContainer($container);


$settings = require __DIR__ . '/../app/settings.php';
$settings($container);

$connection = require __DIR__. '/../app/connection.php';
$connection($container);


$table = "{$container->get('settings')['connection']['dbname']}.users" ;
$columns = "ID INTEGER (11) NOT NULL AUTO_INCREMENT PRIMARY KEY, Name VARCHAR (55) NOT NULL, Email VARCHAR (55) NOT NULL";
$container->get('connection')->exec("CREATE TABLE IF NOT EXISTS {$table} ({$columns})");

$sql ="INSERT INTO users (name, email) VALUES ('Keith','owirakeith57@gmail.com')";


    if ($container->get('connection')->exec($sql) !== false) {
        echo "Successfully Inserted Keith into users table";
    } else {
        echo "ERROR: {$sql} - {$container->get('connection')->errorInfo()[2]}";
    }

$logger = require __DIR__ . '/../app/logger.php';
$logger($container);


$app = AppFactory::create();

$views = require __DIR__ .'/../app/views.php';
$views($app);

$middleware = require __DIR__ . '/../app/middleware.php';
$middleware($app);

$routes = require __DIR__ .'/../app/routes.php';
$routes ($app);



$app->run();
