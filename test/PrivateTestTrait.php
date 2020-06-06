<?php

declare(strict_types=1);

namespace Movement\test;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionMethod;

trait PrivateTestTrait
{
    /**
    *   call method
    *
    *   @param object|string $class 対象オブジェクト
    *   @param string $method_name メソッド名
    *   @param array $arguments 引数
    */
    public function callPrivateMethod(
        $class,
        $method_name,
        $arguments = []
    ) {
        $reflectionMethod = new ReflectionMethod($class, $method_name);
        $reflectionMethod->setAccessible(true);
        return $reflectionMethod->invokeArgs($class, $arguments);
    }
    
    /**
    *   get property
    *
    *   @param object|string $object 対象クラス
    *   @param string $property_name プロパティ名
    *   @return mixed
    */
    public function getPrivateProperty($object, $property_name)
    {
        return $this->doPropertyProcess(
            [$this, 'doGetProperty'],
            $object,
            $property_name
        );
    }
    
    /**
    *   set property
    *
    *   @param object|string $class 対象クラス
    *   @param string $property_name プロパティ名
    *   @param mixed $value 値
    *   @returm mixed
    */
    public function setPrivateProperty($class, $property_name, $value)
    {
        return $this->doPropertyProcess(
            [$this, 'doSetProperty'],
            $class,
            $property_name,
            $value
        );
    }
    
    /**
    *  プロパティ処理ルーチン
    *
    *   @param callable $process 処理本体
    *   @param object|string $class 対象クラス
    *   @param string プ$property_name ロパティ名
    *   @param ?mixed 設定値
    *   @param ?object $target 対象オブジェクト
    *   @return mixed
    *   @throws InvalidArguentException
    */
    protected function doPropertyProcess(
        $process,
        $class,
        $property_name,
        $value = null,
        $target = null
    ) {
        $reflectionClass = new ReflectionClass($class);
        
        if ($reflectionClass->hasProperty($property_name)) {
            $reflectionProperty =
                $reflectionClass->getProperty($property_name);
            $reflectionProperty->setAccessible(true);
            
            $object = $target ?? $class;
            
            //do process
            return $process($reflectionProperty, $object, $value);
        }
        
        if (($parent = $reflectionClass->getParentClass()) === false) {
            throw new InvalidArgumentException(
                "{$class} not have:{$property_name}"
            );
        }
        return $this->doPropertyProcess(
            $process,
            $parent->getName(),
            $property_name,
            $value,
            $class
        );
    }
    
    /**
    *   doGetProperty
    *
    *   @param ReflectionProperty $reflectionProperty
    *   @param object|string $object
    *   @param mixed $dummy
    *   @return mixed
    */
    protected function doGetProperty(
        ReflectionProperty $reflectionProperty,
        $object,
        $dummy
    ) {
        return $reflectionProperty->getValue($object);
    }
    
    /**
    *   doSetProperty
    *
    *   @param ReflectionProperty $reflectionProperty
    *   @param object|string $object
    *   @param mixed $value
    *   @return mixed
    */
    protected function doSetProperty(
        ReflectionProperty $reflectionProperty,
        $object,
        $value
    ) {
        if ($reflectionProperty->isStatic()) {
            return $reflectionProperty->setValue($value);
        }
        return $reflectionProperty->setValue($object, $value);
    }
}
