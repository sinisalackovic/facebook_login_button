<?php

use App\Server;
use G4\Router\Map;
use G4\Router\RouteFactory;
use G4\Router\DefinitionFactory;

$attach = [
     '/' => [
        'routes' => [
            [
                'path' => '/?{:service}?/{:rest*}',
                'values' => [
                    'module'  => 'front',
                    'service' => 'index',
                ],
            ]
        ]
    ]
];

$router = new Map(new DefinitionFactory, new RouteFactory, $attach);

$route = $router->match(parse_url((new Server())->requestUri(), PHP_URL_PATH), $_SERVER);

return isset($route->values) ? $route->values : array();
