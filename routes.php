<?php

use App\Controller\TasksController;
use Framework\Routing\RouteCollection;
use App\Controller\SecurityController;

$routes = new RouteCollection();

$routes->get('tasks', '/', [new TasksController, 'tasks']);
$routes->any('create_task', '/tasks/create', [new TasksController, 'create']);
$routes->any('task', '/tasks/{id}', [new TasksController, 'edit']);

$routes->any('login', '/login', [new SecurityController, 'login']);
$routes->get('logout', '/logout', [new SecurityController, 'logout']);

return $routes;
