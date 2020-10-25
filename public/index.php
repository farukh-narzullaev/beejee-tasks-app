<?php

session_start();

require_once '../vendor/autoload.php';
require_once '../config/config.php';

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Routing\Router;

$routes  = require_once '../routes.php';
$router  = new Router($routes);
$request = Request::createFromGlobals();

try {
    $matchedRoute = $router->match($request);

    foreach ($matchedRoute->getAttributes() as $name => $value) {
        $request->addAttribute($name, $value);
    }

    $handler = $matchedRoute->getHandler();
    $response = $handler($request);
} catch (Exception $e) {
    $response = new Response($e->getMessage());
}

$response->send();
