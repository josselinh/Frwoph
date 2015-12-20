<?php

namespace Frwoph\Vendors\FrwophRouter;

class FrwophRouterRoute
{

    private $route;
    private $controller;
    private $action;

    public function __construct($route, $controller, $action)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

}
