<?php

namespace Frwoph\Vendor\Frwoph\Router;

/**
 * RouterConfigInterface
 * @author Josselin
 */
interface RouterConfigInterface
{
    /**
     * Add a route into the list
     * @param string $name Name of the route
     * @param string $path Path is the url
     * @param string $controller Name of the controller
     * @param string $action Name of the action
     * @return \Frwoph\Vendor\Frwoph\Router\RouterConfig
     * @throws Exception
     */
    public function add($name = 'default', $path = '/', $controller = null, $action = null);
    
    /**
     * Return all routes
     * @return array
     */
    public function getRoutes();
}

