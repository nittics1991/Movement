<?php

/**
*   ReflectAttributeTrait
*
*   @version 200516
*/

declare(strict_types=1);

namespace Movement\accessor;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionProperty;

trait ReflectePropertyTrait
{
    /**
    *   properties
    *
    *   @var ReflectionProperty[] [name=>ReflectionProperty, ...]
    */
    private array $properties = [];
    
    /*
    *   classでpropertyを定義する
    *
    *   public string $fullName;     set/get OK
    *   protected string $fullName;  get only
    *   private string $fullName;    private
    */
    
    /**
    *   classのpropertyを解析してpropertiesに定義
    *
    */
    protected function reflecteProperty()
    {
        $reflectionClass = new ReflectionClass($this);
        $properties = $reflectionClass->getProperties(
            ReflectionProperty::IS_PROTECTED |
            ReflectionProperty::IS_PUBLIC
        );
        
        foreach ($properties as $property) {
            if ($property->getName() == 'properties') {
                continue;
            }
            $this->properties[$property->getName()] = $property;
        }
    }
    
    /**
    *   has
    *
    *   @param string $name
    *   @return bool
    */
    public function has(string $name): bool
    {
        if (!isset($this->properties)) {
            $this->reflecteProperty();
        }
        return array_key_exists($name, $this->properties);
    }
    
    /**
    *   {inherit}
    *
    **/
    public function __get(string $name)
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException(
                "not defined property:{$name}"
            );
        }
        return $this->$name;
    }
    
    /**
    *   {inherit}
    *
    **/
    public function __isset(string $name): bool
    {
        return $this->has($name)
            && isset($this->$name);
    }
    
    /**
    *   isWritable
    *
    *   @param string $name
    *   @return bool
    */
    public function isWritable(string $name): bool
    {
        return $this->has($name)
            && ($this->properties[$name])->isPublic();
    }
    
    /**
    *   fromArray
    *
    *   @param array $data
    */
    protected function fromArray(array $data)
    {
        if (!isset($this->properties)) {
            $this->reflecteProperty();
        }
        
        foreach ($data as $name => $val) {
            if (!array_key_exists($name, $this->properties)) {
                throw new InvalidArgumentException(
                    "not defined property:{$name}"
                );
            }
            
            if (($this->properties[$name])->isPrivate()) {
                throw new InvalidArgumentException(
                    "invalid visibility:{$name}"
                );
            }
            $this->$name = $val;
        }
        return $this;
    }
    
    /**
    *   toArray
    *
    *   @return array
    */
    public function toArray(): array
    {
        if (!isset($this->properties)) {
            $this->reflecteProperty();
        }
        
        return array_map(
            function ($name) {
                return $this->$name;
            },
            array_keys($this->properties)
        );
    }
        
    /**
    *   getProperties
    *
    *   @return array
    */
    public function getProperties(): array
    {
        if (!isset($this->properties)) {
            $this->reflecteProperty();
        }
        return $this->properties;
    }
}
