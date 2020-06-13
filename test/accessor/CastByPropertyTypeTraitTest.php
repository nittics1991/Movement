<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\{
    CastByPropertyTypeTrait,
    ReflectePropertyTrait
};
use StdClass;

/**
*   CastByPropertyTypeTraitで操作するクラス
*/
class CastByPropertyTypeTraitTarget extends StdClass
{
    use CastByPropertyTypeTrait;
    use ReflectePropertyTrait;
    
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
}

class CastByPropertyTypeTraitReferer
{
    use ReflectePropertyTrait;
    
    public int $class_int_public;
    protected int $class_int_protected;
    private int $class_int_private;
}

////////////////////////////////////////////////////////////////////////////////

class CastByPropertyTypeTraitTest extends MovementTestCase
{
    /**
    *
    */
    public function castByPropertyTypeメソッドdataProvider()
    {
        return [
            ['non_data', 'NON_DATA', 'NON_DATA'],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider castByPropertyTypeメソッドdataProvider
    */
    public function castByPropertyTypeメソッド(
        $property_name,
        $data,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new CastByPropertyTypeTraitTarget();
        
        $this->callPrivateMethod(
            $obj,
            'castByPropertyType',
            [
                $property_name,
                $data
            ]
        );
        
        $this->assertEquals(
            $expect,
            $this->getPrivateProperty(
                $obj,
                $property_name
            )
        );
    }
}
