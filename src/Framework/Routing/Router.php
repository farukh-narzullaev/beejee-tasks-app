<?php

namespace Framework\Routing;

use Framework\Http\RequestInterface;

class Router
{
    private $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    public function match(RequestInterface $request)
    {
        foreach ($this->routes->getRoutes() as $route) {
            if (null !== $matchedRoute = $route->match($request)) {
                return $matchedRoute;
            }
        }

        throw new RequestNotMatchedException('Matches not found.');
    }
}
