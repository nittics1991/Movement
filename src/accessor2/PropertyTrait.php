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
    
    /**
    *   acceptedByDefinedProperty
    *
    *   @param string $name
    *   @return void
    *       __setに追加する
    */
    protected function acceptedByDefinedProperty(string $name, $value)
    {
        if ($this->has($name)) {
            $this->$name = $value;
        }
        throw new InvalidArgumentException(
            "property is not defined:{$name}"
        );
    }
    
    /**
    *   refuzedAnUnset
    *
    *   @param string $name
    *   @return void
    *       __unsetに追加する
    */
    protected function refuzedAnUnset(string $name)
    {
        throw new InvalidArgumentException(
            "refuse an unset property:{$name}"
        );
    }
    
    
    
    
}
