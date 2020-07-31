<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\ReflectePropertyTrait;

//use BadMethodCallException;
//use InvalidArgumentException;
//use ArrayObject;
//use StdClass;
//use TypeError;

/**
*   ReflectePropertyTraitで操作するクラス(様々な型)
*/
class ReflectePropertyTrait2Target
{
    use ReflectePropertyTrait{
        fromAggregate as public;
    }
    
    protected $non_data;
    protected bool $bool_data;
    protected int $int_data;
    protected float $float_data;
    protected string $string_data;
    protected array $array_data;
    protected object $object_data;
    protected iterable $itelable_data;
    protected parent $parent_data;
    protected self $self_data;
    protected StdClass $stdclass_data;
    
    protected ?string $string_data_null;
    
    public string $string_data_public;
    
    protected ?string $string_data_defined = 'STRING_DATA_DEFINED';
    protected ?string $string_data_defined_null = 'STRING_DATA_DEFINED';
}

////////////////////////////////////////////////////////////////////////////////

class ReflectePropertyTrait2Test extends MovementTestCase
{
    /**
    *   @test
    */
    public function getメソッド()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTrait2Target();
        
        
        isset($obj->bool_data);
        
        
        //var_dump($obj->toArray());
        
        
        //$this->assetEquals(0,0);
        
        
        
        
    }
}
