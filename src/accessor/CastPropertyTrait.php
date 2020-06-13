<?php

//どうやって使う?
//AccessorTrait::setter?
//ReflectionPropertyTrait::__set()では public propertyはだめ
//ReflectionPropertyTrait::__get()では、そもそも型が定義できない


/**
*   CastPropertyTrait
*
*   @version 200613
*/

declare(strict_types=1);

namespace Movement\accessor;

use ArrayObject;

trait CastPropertyTrait
{
    /**
    *   子クラスで下記propertyを定義する
    */
    
    /**
    *   casts
    *
    *   @var string[] ['propertyName1', ...]
    */
    //private array $casts = [];
   
    /**
    *   プロパティで型変換
    *
    *   @param string $name
    *   @param mixed $val
    *   @return mixed
    */
    protected function castByProperty(string $name, $val)
    {
        //前提条件
        assert(property_exists($this, 'casts'));
        assert(property_exists($this, 'properties'));
        assert(method_exists($this, 'reflecteProperty'));
        
        if (!in_array($name, $this->casts)) {
            return $this->$name = $val;
        }
        
        
        
        $type = ($this->properties[$name])
            ->getType()
            ->getName();
        
        switch ($type) {
            case '':
            case 'callable':
                return $val;
            case 'bool':
                return boolval($val);
            case 'float':
                return floatval($val);
            case 'int':
                return intval($val);
            case 'string':
                return strval($val);
            case 'array':
                return (array)$val;
            case 'object':
                if (is_object($val)) {
                    return $val;
                }
                return (object)$val;
            case 'iterable':
                if (is_iterable($val)) {
                    return $val;
                }
                return new ArrayObject($val);
            case 'self':
                $type = get_called_class();
                // no break
            default:
                if (is_object($val)) {
                    return $val;
                }
                return new $type($val);
        }
    }
}
