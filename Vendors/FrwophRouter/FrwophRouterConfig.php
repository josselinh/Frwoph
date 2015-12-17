<?php

namespace Frwoph\Vendors\FrwophRouter;

class FrwophRouterConfig
{

    private $routes;

    public function addRoute(FrwophRouterRoute $route, $name = null)
    {
        $this->routes[$name] = $route;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getRoute($name = null)
    {
        return $this->routes[$name];
    }

}
