<?php

namespace Frwoph\Vendor\Frwoph\DependencyInjection;

use ReflectionClass;

class DependencyInjection
{

    private $dependencyInjectionConfig;

    public function setConfig(DependencyInjectionConfig $config)
    {
        $this->dependencyInjectionConfig = $config;
    }

    public function instanciate($name)
    {
        $constructors = array();

        if ($this->dependencyInjectionConfig->getClass($name)) {
            if (class_exists($this->dependencyInjectionConfig->getClass($name)['fullClassName'], true)) {
                if (!empty($this->dependencyInjectionConfig->getClass($name)['constructors'])) {
                    foreach ($this->dependencyInjectionConfig->getClass($name)['constructors'] as $constructor) {
                        if ($constructor[0] === '@') {
                            $instanciate = $this->instanciate(substr($constructor, 1));

                            $constructors[] = $instanciate;
                        } else {
                            $constructors[] = $constructor;
                        }
                    }
                }
            } else {
                throw new DependencyInjectionClassNotFoundException($this->dependencyInjectionConfig->getClass($name)['fullClassName']);
            }
        } else {
            throw new DependencyInjectionNotFoundException($name);
        }

        $reflection = new ReflectionClass($this->dependencyInjectionConfig->getClass($name)['fullClassName']);

        return $reflection->newInstanceArgs($constructors);
    }

}
