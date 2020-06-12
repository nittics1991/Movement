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
    *   properties(only protected property)
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
    
    
    
    //reflecteProperty()は名前だけ保持?
    
    
    /**
    *   classのpropertyを解析してpropertiesに定義
    *
    */
    protected function reflecteProperty()
    {
        $reflectionClass = new ReflectionClass($this);
        $properties = $reflectionClass->getProperties(
            ReflectionProperty::IS_PROTECTED
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
        //public property
        foreach ($this as $property => $val) {
            if ($name === $property) {
                return true;
            }
        }
        
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
        foreach ($this as $property => $val) {
            if ($name === $property) {
                return true;
            }
        }
        return false;
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
    *   {inherit}
    *
    **/
    public function __unset(string $name): void
    {
        if ($this->has($name)) {
            unset($this->properties[$name]);
        }
    }
    
    /**
    *   fromArray
    *
    *   public/protectedプロパティを設定
    * 
    *   @param array $data
    * 
    */
    protected function fromArray(array $data)
    {
        if (empty($this->properties)) {
            $this->reflecteProperty();
        }
        
        $public_properties = [];
        foreach ($this as $property => $val) {
            $public_properties[] = $property;
        }
        
        foreach ($data as $name => $val) {
            if (!in_array($name, $public_properties)
                && !array_key_exists($name, $this->properties)
            ) {
                throw new InvalidArgumentException(
                    "not defined property:{$name}"
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
        
        $public_properties = [];
        foreach ($this as $property => $val) {
            $public_properties[$property] = $val;
        }
        
        $protected_properties = [];
        foreach (array_keys($this->$properties as $property) {
            $protected_properties[$property] = $this->$property;
        }
        
        return array_merge($public_properties, $protected_properties);
    }
        
    /**
    *   getProperties
    *
    *   @return string[]
    */
    public function getProperties(): array
    {
        
        //public/protected判断できない
        
        return array_keys($this->toArray());
    }
}
