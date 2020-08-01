<?php

/**
*   CastByPropertyTypeTrait
*
*   @version 200801
*/

declare(strict_types=1);

namespace Movement\accessor;

use ArrayObject;
use DateTime;
use DateTimeInterface;

trait CastByPropertyTypeTrait
{
    /**
    *   子クラスで下記propertyを定義する
    */
    
    /**
    *   casts
    * 
    *   castするプロパティを列挙する
    *
    *   @var string[] ['propertyName1', ...]
    */
    //protected array $casts = [];
    
    /**
    *   cast_rules
    *
    *   @var callable[] ['type' => callable($val, $type), ...]
    *       '':型未定義
    *       '*':castルールに合致無し
    */
    protected array $cast_rules = [];
    
    /**
    *   cast_rules初期化
    *
    */
    protected function initCastRules()
    {
        $this->cast_rules = [
            '' => fn($val, $type) => $val,
            '*' => fn($val, $type) => is_object($val)? $val:new $type($val),
            'bool' => fn($val, $type) => (bool)$val,
            'int' => fn($val, $type) => (int)$val,
            'float' => fn($val, $type) => (float)$val,
            'string' => fn($val, $type) => (string)$val,
            'array' => fn($val, $type) => (array)$val,
            'object' => fn($val, $type) => is_object($val)? $val:(object)$val,
            'iterable' => function($val, $type) {
                return is_iterable($val)? $val : new ArrayObject([$val]);
            },
            'parent' => function($val, $type) {
                $cls = get_parent_class($this);
                return new $cls($val, $type);
            },
            'self' => function($val, $type) {
                $cls = get_called_class();
                return new $cls($val);
            },
            'DateTimeInterface' => function($val, $type) {
                return $val instanceof DateTimeInterface?
                    $val:
                    new DateTime($val);
            },
        ];
    }
    
    /**
    *   プロパティで型変換
    *
    *   @param string $name
    *   @param mixed $val
    *   @return mixed
    */
    protected function castByPropertyType(string $name, $val)
    {
        //前提条件
        assert(property_exists($this, 'casts'));
        assert(property_exists($this, 'properties'));
        assert(method_exists($this, 'reflecteProperty'));
        
        if (empty($this->cast_rules)) {
            $this->initCastRules();
        }
        
        if (!in_array($name, $this->casts)) {
            return $val;
        }
        
        if (empty($this->properties)) {
            $this->reflecteProperty();
        }
        
        $reflectionType = ($this->properties[$name])->getType();
        
        if (is_null($reflectionType)) {
            return $val;
        }
        
        //??? ReflectionType. not ReflectionNamedType
        $type = $reflectionType->getName();
        
        if (mb_substr($type, 0, 1) === '?') {
            $type = mb_substr($type, 1);
        }
        
        $rule_type = array_key_exists($type, $this->cast_rules)?
            $type:'*';
        
        $cast_function = $this->cast_rules[$rule_type];
        return call_user_func($cast_function, $val, $type);
    }
    
    /**
    *   型一括変換
    *
    *   @param iterable|object $aggregate
    *   @return array
    */
    protected function castAggregateToArray($aggregate): array
    {
        $result = [];
        foreach ($aggregate as $name => $val) {
            $result[$name] = $this->castByPropertyType($name, $val);
        }
        return $result;
    }
}
