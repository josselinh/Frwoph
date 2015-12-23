<?php

namespace Frwoph;

use Exception;
use Frwoph\Vendor\Frwoph\DependencyInjection\DependencyInjection;
use Frwoph\Vendor\Frwoph\DependencyInjection\DependencyInjectionClassNotFoundException;
use Frwoph\Vendor\Frwoph\DependencyInjection\DependencyInjectionNotFoundException;
use Frwoph\Vendor\Frwoph\Response\Response;
use Frwoph\Vendor\Frwoph\Router\RouteNotFoundException;
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

            $dependencyInjection = new DependencyInjection();
            $dependencyInjection->setConfig($this->configs['dependencies']);
            $controller = $dependencyInjection->instanciate('controller.' . $router->getController());

            $response = call_user_func_array(array($controller, $router->getAction() . 'Action'), $router->getArgs());
            echo $response->render();
        } catch (RouteNotFoundException $routeNotFoundException) {
            try {
                $response = new Response(new View('Errors/404'), 404);
                echo $response->render();
            } catch (Exception $ex) {
                pr(array($ex->getCode(), $ex->getFile(), $ex->getLine(), $ex->getMessage()));
                die;
            }
        } catch (DependencyInjectionNotFoundException $dependencyInjectionException) {
            pr(array(get_class($dependencyInjectionException), $dependencyInjectionException->getCode(), $dependencyInjectionException->getFile(), $dependencyInjectionException->getLine(), $dependencyInjectionException->getMessage()));
            die;
        } catch (DependencyInjectionClassNotFoundException $dependencyInjectionClassException) {
            pr(array(get_class($dependencyInjectionClassException), $dependencyInjectionClassException->getCode(), $dependencyInjectionClassException->getFile(), $dependencyInjectionClassException->getLine(), $dependencyInjectionClassException->getMessage()));
            die;
        }
    }

}
