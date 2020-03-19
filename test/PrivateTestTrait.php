<?php

/**
*   PrivateTestTrait
*
*   @ver 200320
*/

declare(strict_types=1);

namespace Concerto\test;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

trait PrivateTestTrait
{
    /**
    *   privateメソッド実行
    *
    *   @param object|string $obj 対象クラス
    *   @param string $methodName メソッド名
    *   @params array $args メソッド引数
    *   @return mixed
    */
    public function callPrivateMethod(
        $obj,
        string $methodName,
        array $args = []
    ) {
        $refMethod = new ReflectionMethod($obj, $methodName);
        $refMethod->setAccessible(true);
        return $refMethod->invokeArgs($obj, $args);
    }
    
    /**
    *   privateプロパティ取得
    *
    *   @param object|string $obj 対象クラス
    *   @param string $propertyNameName プロパティ名
    *   @return mixed
    */
    public function getPrivateProperty(
        $obj,
        string $propertyNameName
    ) {
        return $this->doPropertyProcess(
            [$this, 'doGetProperty'],
            $obj,
            $propertyNameName
        );
    }
    
    /**
    *   privateプロパティ設定
    *
    *   @param object|string $obj 対象クラス
    *   @param string $propertyNameName プロパティ名
    *   @param mixed $value 値
    */
    public function setPrivateProperty(
        $obj,
        $propertyNameName,
        $value
    ) {
        return $this->doPropertyProcess(
            [$this, 'doSetProperty'],
            $obj,
            $propertyNameName,
            $value
        );
    }
    
    /**
    *  プロパティ処理ルーチン
    *
    *   @param callable $process 処理本体
    *   @param object|string $obj 対象クラス
    *   @param string $propertyName プロパティ名
    *   @param ?mixed $value 設定値
    *   @param ?object $target 対象オブジェクト
    *   @return mixed
    *   @throws InvalidArguentException
    */
    protected function doPropertyProcess(
        callable $process,
        $obj,
        string $propertyName,
        $value = null,
        $target = null
    ) {
        $refClass = new ReflectionClass($obj);
        
        if ($refClass->hasProperty($propertyName)) {
            $refProp = $refClass->getProperty($propertyName);
            $refProp->setAccessible(true);
            
            $obj = (isset($target)) ? $target : $obj;
            
            //do process
            return $process($refProp, $obj, $value);
        }
        
        if (($parent = $refClass->getParentClass()) === false) {
            throw new InvalidArgumentException(
                "{$obj} not have:{$propertyName}"
            );
        }
        return $this->doPropertyProcess(
            $process,
            $parent->getName(),
            $propertyName,
            $value,
            $obj
        );
    }
      
    /**
    *   doGetProperty
    *
    *   @param ReflectionProperty $refProp
    *   @param object|string $obj
    *   @return mixed
    */
    protected function doGetProperty(
        ReflectionProperty $refProp,
        $obj
    ) {
        return $refProp->getValue($obj);
    }
    
    /**
    *   doSetProperty
    *
    *   @param ReflectionProperty $refProp
    *   @param object|string $value
    *   @param mixed $obj
    *   @return void
    */
    protected function doSetProperty(
        ReflectionProperty $refProp,
        $obj,
        $value
    ) {
        if ($refProp->isStatic()) {
            return $refProp->setValue($value);
        }
        return $refProp->setValue($obj, $value);
    }
}
