<?php

namespace Frwoph\Vendors\FrwophDependencyInjection;

class FrwophDependencyInjectionConfig
{

    private $classes = array();

    public function add($name, $fullClassName, $constructors = array())
    {
        $this->classes[$name] = new \stdClass();
        $this->classes[$name]->fullClassName = $fullClassName;
        $this->classes[$name]->constructors = $constructors;
    }

    public function getClass($name)
    {
        return $this->classes[$name];
    }

}
