<?php

/**
*   ReflectAttributeTrait
*
*   @version 200801
*
*/

declare(strict_types=1);

namespace Movement\accessor;

trait PropertyTrait
{
    /**
    *   properties
    *
    *   @var string[] [property_name, ...]
    *       クラスで定義する
    */
    //protected array $properties = [];
    
    /*
    *   classでpropertyを定義する
    *
    *   mutableはpublic
    *   immutableはprotected|private
    */
    
    /**
    *   getProperties
    *
    *   @return array
    */
    public function getProperties(): array
    {
        return $this->properties;
    }
    
    /**
    *   has
    *
    *   @param string $name
    *   @return bool
    */
    public function has(string $name): bool
    {
        return in_array($name, $this->properties);
    }
}
