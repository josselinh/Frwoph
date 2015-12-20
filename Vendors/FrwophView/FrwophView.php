<?php

namespace Frwoph\Vendors\FrwophView;

class FrwophView implements FrwophViewInterface
{
    private $page;
    private $values;
    private $layout;

    public function __construct($page = null, $values = array(), $layout = 'default')
    {
        $this->page = $page;
        $this->values = $values;
        $this->layout = $layout;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function setValues($values)
    {
        $this->values += $values;
    }

    public function addValue($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render()
    {
        ob_start();
        $layout = APP_VIEWS . DS . 'Layouts' . DS . $this->layout . '.php';
        
        if (file_exists($layout)) {
            $view = APP_VIEWS . DS . $this->page . '.php';

            if (file_exists($view)) {
                require_once $layout;
                return ob_get_clean();
            } else {
                throw new Exception('View not found');
            }
        } else {
            throw new Exception('Layout not found');
        }
    }

    public function __get($name)
    {
        return $this->values[$name];
    }
}
