<?php

namespace Frwoph;

use Exception;
use Frwoph\Vendor\Frwoph\Exceptions\RouteNotFoundException;
use Frwoph\Vendor\Frwoph\Response\Response;
use Frwoph\Vendor\Frwoph\Router\Router;
use Frwoph\Vendor\Frwoph\View\View;

class Bootstrap
{

    private $configs = array();

    public function __construct($appDir = null)
    {
        $this->setAppConstants($appDir);
    }

    /**
     * Set all the needed constants for the application
     * @param string $appDir
     */
    private function setAppConstants($appDir = null)
    {
        /*
         * @todo
         * AppDir check comes later
         */

        define('APP_ROOT', $appDir);
        define('APP_CONFIGURATIONS', APP_ROOT . DS . 'Configurations');
        define('APP_CONTROLLERS', APP_ROOT . DS . 'Controllers');
        define('APP_MODELS', APP_ROOT . DS . 'Models');
        define('APP_REPOSITORIES', APP_ROOT . DS . 'Repositories');
        define('APP_SERVICES', APP_ROOT . DS . 'Services');
        define('APP_VIEWS', APP_ROOT . DS . 'Views');
    }

    public function addConfig($name, $value)
    {
        $this->configs[$name] = $value;
    }

    public function execute()
    {
        try {
            $router = new Router();
            $router->setConfig($this->configs['routes']);
            $router->dispatch();
        } catch (RouteNotFoundException $routeNotFoundException) {
            try {
                $response = new Response(new View('Errors/404'), 404);
                echo $response->render();
            } catch (Exception $ex) {
                pr(array($ex->getCode(), $ex->getFile(), $ex->getLine(), $ex->getMessage()));
                die;
            }
        }

        echo $router->getName() . ' ' . $router->getController() . ' ' . $router->getAction() . ' ' . print_r($router->getArgs(), true);

        exit;

        $frwophDependencyInjection = new Vendors\FrwophDependencyInjection\FrwophDependencyInjection();
        $frwophDependencyInjection->setConfig($this->configs['dependencies']);
        $controller = $frwophDependencyInjection->instanciate('controller.' . $frwophRouter->getController());

        $response = call_user_func_array(array($controller, $frwophRouter->getAction() . 'Action'), $frwophRouter->getArgs());
        echo $response->render();
    }

}
