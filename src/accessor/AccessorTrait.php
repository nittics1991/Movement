<?php

/**
*   AccessorTrait
*
*   @version 200613
*/

declare(strict_types=1);

namespace Movement\accessor;

use BadMethodCallException;

trait AccessorTrait
{
    /*
    *   classで下記propertyを定義する
    *
    */
    
    /**
    *   getters
    *
    *   @var string[] ['propertyName1', ...]
    */
    //protected array $getters = [];
     
    /**
    *   setters
    *
    *   @var string[] ['propertyName1', ...]
    */
    //protected array $setters = [];
    
    /**
    *   methodNameToPropertyName
    *
    *   @param string $method_name
    *   @return string
    */
    protected function methodNameToPropertyName(
        string $method_name
    ): string {
        return (string)mb_strtolower(
            (string)mb_ereg_replace('(.)(?=[A-Z])', '\\1_', $method_name)
        );
    }
    
    /**
    *   callAccessor
    *
    *   @param string $name
    *   @param array $arguments
    *   @return mixed
    */
    protected function callAccessor(string $name, array $arguments = [])
    {
        //前提条件
        assert(property_exists($this, 'getters'));
        assert(property_exists($this, 'setters'));
        
        $action = mb_substr($name, 0, 3);
        if ($action !== 'set' && $action !== 'get') {
            throw new BadMethodCallException(
                "not get/set method:{$name}"
            );
        }
        
        $property_name = $this->methodNameToPropertyName(
            mb_substr($name, 3)
        );
        
        if (
            $action === 'get'
            && in_array($property_name, $this->getters)
        ) {
            return $this->$property_name;
        }
        
        if (
            $action === 'set'
            && isset($arguments[0])
            && in_array($property_name, $this->setters)
        ) {
            return $this->$property_name = $arguments[0];
        }
        
        throw new BadMethodCallException(
            "not defined accesor method:{$name}"
        );
    }
    
    /**
    *   {inherit}
    *
    */
    public function __call(string $name, array $arguments)
    {
        return $this->callAccessor($name, $arguments);
    }
}
