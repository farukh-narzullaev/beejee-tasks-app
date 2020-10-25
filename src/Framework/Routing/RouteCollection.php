<?php

namespace Framework\Routing;

class RouteCollection
{
    /**
     * @var Route[]
     */
    private $routes = [];

    public function any(string $name, string $pattern, $handler, array $requirements = [])
    {
        $this->routes[] = new Route($name, $pattern, $handler, ['GET', 'POST'], $requirements);
    }

    public function get(string $name, string $pattern, $handler, array $requirements = [])
    {
        $this->routes[] = new Route($name, $pattern, $handler, ['GET'], $requirements);
    }

    public function post(string $name, string $pattern, $handler, array $requirements = [])
    {
        $this->routes[] = new Route($name, $pattern, $handler, ['POST'], $requirements);
    }

    /**
     * @return Route[]
     */
    public function getRoutes()
    {
        return $this->routes;
    }
}
