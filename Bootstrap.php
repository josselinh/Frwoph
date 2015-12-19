<?php

namespace Frwoph;

use Frwoph\Vendors\FrwophRouter\FrwophRouter;

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
        $frwophRouter = new FrwophRouter($this->configs['routes']);
        echo 'Controller = ' . $frwophRouter->getController() . '<br />';
        echo 'Action = ' . $frwophRouter->getAction() . '<br />';
        echo 'Args = ' . print_r($frwophRouter->getArgs(), true) . '<br />';

        $frwophDependencyInjection = new Vendors\FrwophDependencyInjection\FrwophDependencyInjection();
        $frwophDependencyInjection->setConfig($this->configs['dependencies']);
        $controller = $frwophDependencyInjection->instanciate('controller.' . $frwophRouter->getController());

        $response = call_user_func_array(array($controller, $frwophRouter->getAction() . 'Action'), $frwophRouter->getArgs());
        pr($response);

        echo 'execute successfully';
    }

}
