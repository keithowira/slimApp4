<?php

declare(strict_types=1);


use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;


return function (App $app){
    $app ->get('/hello/{name}',function (RequestInterface $request, ResponseInterface $response, $parameters) {

        $name = $parameters['name'];
        $response -> getBody()->write("Hello $name!");
    
        return $response;
    });

    $container = $app ->getContainer();

    $app ->group ('',function (RouteCollectorProxy $view) {

        $view->get('/example/{name}',function ( $request, $response, $parameters) {

            $name = $parameters['name'];
        
            return $this->get('view')->render($response,'example.twig',compact('name'));

    });
    
 
    })->add($container->get('viewMiddleware'));

};
