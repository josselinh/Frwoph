<?php

namespace Frwoph\Vendor\Frwoph\Router;

/**
 * RouterInterface
 * @author Josselin
 */
interface RouterInterface
{
    /**
     * Set configuration
     * @param \Frwoph\Vendor\Frwoph\Router\RouterConfigInterface $routerConfig
     */
    public function setConfig(RouterConfigInterface $routerConfig);
    
    /**
     * Execute the router system
     */
    public function dispatch();
    
    /**
     * Get the route name
     * @return string
     */
    public function getName();

    /**
     * Get the controller name
     * @return string
     */
    public function getController();

    /**
     * Get the action name
     * @return string
     */
    public function getAction();

    /**
     * Get the args
     * @return array
     */
    public function getArgs();
}
