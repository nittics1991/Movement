<?php

/**
*   CastByPropertyTypeTrait
*
*   @version 200614
*/

declare(strict_types=1);

namespace Movement\accessor;

use ArrayObject;

trait CastByPropertyTypeTrait
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
    protected function castByPropertyType(string $name, $val)
    {
        //前提条件
        assert(property_exists($this, 'casts'));
        assert(property_exists($this, 'properties'));
        assert(method_exists($this, 'reflecteProperty'));
        
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
        
        switch ($type) {
            case '':
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
                
            /*以下不動作?*/
            case 'iterable':
                if (is_iterable($val)) {
                    return $val;
                }
                return new ArrayObject([$val]);
            case 'parent':
            case 'self':
                $type = $type === 'parent' ?
                    get_parent_class($this):
                    get_called_class();
                // no break
            default:
                if (is_object($val)) {
                    return $val;
                }
                return new $type($val);
        }
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
