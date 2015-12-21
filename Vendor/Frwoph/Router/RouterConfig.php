<?php

namespace Frwoph\Vendor\Frwoph\Router;

/**
 * RouterConfig is a class to configure Frwoph Router system
 * @author Josselin
 */
class RouterConfig implements RouterConfigInterface
{
    /**
     * Contains all routes
     * @var array
     */
    private $routes = array();

    /**
     * {@inheritdoc}
     */
    public function add($name = 'default', $path = '/', $controller = null, $action = null)
    {
        if (!$this->isRouteExists($name)) {
            $this->routes[$name] = array(
                'path' => $path,
                'controller' => $controller,
                'action' => $action
            );
        } else {
            throw new Exception(sprintf('Route "%s (%s)" already exists', $name, $path));
        }
        
        return $this;
    }

    /**
     * Check if route already exists
     * @param string $name Name of the route
     * @return bool
     */
    private function isRouteExists($name = 'default')
    {
        return (isset($this->routes[$name]));
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutes()
    {
        return $this->routes;
    }

}
