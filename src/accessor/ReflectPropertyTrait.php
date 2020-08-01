<?php

/**
*   ReflectAttributeTrait
*
*   @version 200801
*
*/

declare(strict_types=1);

namespace Movement\accessor;

use InvalidArgumentException;
use BadMethodCallException;
use ReflectionClass;
use ReflectionProperty;

trait ReflectPropertyTrait
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
    *   public string $fullName;     mutable proptery
    *   protected string $fullName;  immutable proptery
    *   private string $fullName;    private proptery
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
            if ($property->getName() === 'properties') {
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
        if (empty($this->properties)) {
            $this->reflecteProperty();
        }
        return array_key_exists($name, $this->properties);
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
        return $this->$name ?? null;
    }
    
    /**
    *   {inherit}
    *
    **/
    public function __set(string $name, $value)
    {
        throw new InvalidArgumentException(
            "not defined property:{$name}"
        );
    }
    
    /**
    *   {inherit}
    *
    **/
    public function __isset(string $name): bool
    {
        if (!$this->has($name)
            && !$this->isWritable($name)
        ) {
            return false;
        }
        return isset($this->$name);
    }
    
    /**
    *   {inherit}
    *
    **/
    public function __unset(string $name): void
    {
        throw new BadMethodCallException(
            "can not call unset:{$name}"
        );
    }
    
    /**
    *   fromAggregate(public & protected property)
    *
    *   @param iterable|object $aggregate
    */
    protected function fromAggregate($aggregate)
    {
        if (empty($this->properties)) {
            $this->reflecteProperty();
        }
        
        foreach ($aggregate as $name => $val) {
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
        if (empty($this->properties)) {
            $this->reflecteProperty();
        }
        
        $result = [];
        foreach (array_keys($this->properties) as $name) {
            $result[$name] = $this->$name;
        }
        
        return $result;
    }
    
    /**
    *   getProperties
    *
    *   @return array
    */
    public function getProperties(): array
    {
        if (empty($this->properties)) {
            $this->reflecteProperty();
        }
        return array_keys($this->properties);
    }
}
