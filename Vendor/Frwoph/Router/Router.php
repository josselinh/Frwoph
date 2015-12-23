<?php

namespace Frwoph\Vendor\Frwoph\Router;

/**
 * Router
 * @author Josselin
 */
class Router implements RouterInterface
{

    /**
     * Router configuration
     * @var RouterConfigInterface
     */
    private $routerConfig = null;

    /**
     * Name of the current route
     * @var string
     */
    private $name = null;

    /**
     * Controller of the current route
     * @var string
     */
    private $controller = null;

    /**
     * Action of the current route
     * @var string
     */
    private $action = null;

    /**
     * Arguments of the current route
     * @var array
     */
    private $args = array();

    /**
     * {@intheritdoc}
     */
    public function setConfig(RouterConfigInterface $routerConfig)
    {
        $this->routerConfig = $routerConfig;
    }

    /**
     * {@intheritdoc}
     */
    public function dispatch()
    {
        $requestedPath = $this->getRequestedPath();

        foreach ($this->routerConfig->getRoutes() as $routeName => $routeConfig) {
            $routePath = $routeConfig['path'];

            // Replace path arguments by regular expression
            $routeArgsNameMatches = array();
            $routesArgsValueMatches = array();

            if (preg_match_all('#{(.*)}#Ui', $routePath, $routeArgsNameMatches)) {
                $routePath = preg_replace('#{(.*)}#Ui', '(.*)', $routePath);
            }

            if (preg_match('#^' . $routePath . '$#', $requestedPath, $routesArgsValueMatches)) {
                $this->name = $routeName;
                $this->controller = $routeConfig['controller'];
                $this->action = $routeConfig['action'];

                if (!empty($routeArgsNameMatches[1])) {
                    foreach ($routeArgsNameMatches[1] as $argNum => $argName) {
                        if (!empty($routesArgsValueMatches[$argNum + 1])) {
                            $this->args[$argName] = $routesArgsValueMatches[$argNum + 1];
                        }
                    }
                }
            }
        }

        if (empty($this->name) || empty($this->controller) || empty($this->action)) {
            throw new RouteNotFoundException();
        }
    }

    /**
     * Extract the requested path whatever if modrewrite is on or not
     * @return string
     */
    private function getRequestedPath()
    {
        $uri = parse_url(filter_input(INPUT_SERVER, 'REQUEST_URI'));
        $path = str_replace(filter_input(INPUT_SERVER, 'SCRIPT_NAME'), '', $uri['path']);

        return $path;
    }

    /**
     * {@intheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@intheritdoc}
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * {@intheritdoc}
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * {@intheritdoc}
     */
    public function getArgs()
    {
        return $this->args;
    }

}
