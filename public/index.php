<?php

use PDO;

$dbh = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_4dfc0b5377f7dad', 'b6dde05496a580', 'fe2b10ce');

var_dump($dbh);
die;


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
