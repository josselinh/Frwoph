<?php

namespace Frwoph\Vendors\FrwophRouter;

class FrwophRouter implements FrwophRouterInterface
{

    private $controller = null;
    private $action = null;
    private $args = array();

    public function __construct(FrwophRouterConfig $routes)
    {
        $requested = $_SERVER['REDIRECT_URL'];
        //pr($requested, 'requested');
        //pr($routes);

        foreach ($routes->getRoutes() as $key => $route) {
            /* @var $route FrwophRouterRoute */
            //pr($route, $key);

            $routeRewritten = $route->getRoute();
            $pregMatches = array();
            

            if (preg_match_all('#{(.*)}#Ui', $route->getRoute(), $pregMatches)) {
                $routeRewritten = preg_replace('#{(.*)}#Ui', '(.*)', $route->getRoute());
            }

            //pr($pregMatches, $routeRewritten);

            if (preg_match('#^' . $routeRewritten . '$#', $requested, $reqMatches)) {
                $this->controller = $route->getController();
                $this->action = $route->getAction();
                //pr($reqMatches);
                foreach ($pregMatches[1] as $argNum => $argName) {
                    $this->args[$argName] = $reqMatches[$argNum + 1];
                }
            }
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getArgs()
    {
        return $this->args;
    }

}
