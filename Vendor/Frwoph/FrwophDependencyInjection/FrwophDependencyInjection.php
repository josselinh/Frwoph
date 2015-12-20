<?php

namespace Frwoph\Vendors\FrwophDependencyInjection;

use ReflectionClass;

class FrwophDependencyInjection
{

    private $dependencyInjection;

    public function setConfig(FrwophDependencyInjectionConfig $config)
    {
        $this->dependencyInjection = $config;
    }

    public function instanciate($name)
    {
        $constructors = array();

        if ($this->dependencyInjection->getClass($name)) {
            if (class_exists($this->dependencyInjection->getClass($name)->fullClassName, true)) {
                if (!empty($this->dependencyInjection->getClass($name)->constructors)) {
                    foreach ($this->dependencyInjection->getClass($name)->constructors as $constructor) {
                        if ($constructor[0] === '@') {
                            $instanciate = $this->instanciate(substr($constructor, 1));

                            $constructors[] = $instanciate;
                        } else {
                            $constructors[] = $constructor;
                        }
                    }
                }
            }
        }

        $reflection = new ReflectionClass($this->dependencyInjection->getClass($name)->fullClassName);

        return $reflection->newInstanceArgs($constructors);
    }

}
