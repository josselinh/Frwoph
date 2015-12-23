<?php

namespace Frwoph\Vendor\Frwoph\DependencyInjection;

class DependencyInjectionConfig
{

    private $classes = array();

    public function add($name, $fullClassName, $constructors = array())
    {
        $this->classes[$name] = array(
            'fullClassName' => $fullClassName,
            'constructors' => $constructors
        );
    }

    public function getClass($name)
    {
        if (isset($this->classes[$name])) {
            return $this->classes[$name];
        }

        return false;
    }

}
