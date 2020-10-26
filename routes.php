<?php

use App\Controller\TasksController;
use Framework\Routing\RouteCollection;
use App\Controller\SecurityController;

$routes = new RouteCollection();

$routes->get('tasks', '/', [TasksController::class, 'tasks']);
$routes->any('create_task', '/tasks/create', [TasksController::class, 'create']);
$routes->any('task', '/tasks/{id}', [TasksController::class, 'edit']);

$routes->any('login', '/login', [SecurityController::class, 'login']);
$routes->get('logout', '/logout', [SecurityController::class, 'logout']);

return $routes;
