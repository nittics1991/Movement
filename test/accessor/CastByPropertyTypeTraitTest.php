<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\{
    CastByPropertyTypeTrait,
    ReflectPropertyTrait
};
use ArrayObject;
use StdClass;

/**
*   CastByPropertyTypeTraitで操作するクラス
*/
class CastByPropertyTypeTraitTarget extends StdClass
{
    use CastByPropertyTypeTrait;
    use ReflectPropertyTrait{
        toArray as public;
    }
    
    private $casts = [
        'non_data',
        'bool_data',
        'int_data',
        'float_data',
        'string_data',
        'array_data',
        'object_data',
        'class_data',
        'iterable_data',
        'parent_data',
        'self_data',
    ];
    
    protected $non_data;
    protected bool $bool_data;
    protected int $int_data;
    protected float $float_data;
    protected string $string_data;
    protected array $array_data;
    protected object $object_data;
    protected ArrayObject $class_data;
    protected iterable $iterable_data;
    protected parent $parent_data;
    protected self $self_data;
    
    public function __construct(array $data = [])
    {
        $this->fromAggregate(
            $this->castAggregateToArray($data)
        );
    }
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
            //not defined type
            ['non_data', 'NON_DATA', 'NON_DATA'],
            //bool
            ['bool_data', false, false],
            ['bool_data', '1', true],
            ['bool_data', 0, false],
            //int
            ['int_data', 111, 111],
            ['int_data', '222', 222],
            ['int_data', -3.14, -3],
            //float
            ['float_data', -3.14, -3.14],
            ['float_data', 11, 11.0],
            ['float_data', '9.8', 9.8],
            //string
            ['string_data', 'abc', 'abc'],
            ['string_data', 11.3, '11.3'],
            ['string_data', '漢 字', '漢 字'],
            //array
            ['array_data', ['abc', 'abc'], ['abc', 'abc']],
            ['array_data', [1, [2,3], 'a' => 4], [1, [2,3], 'a' => 4]],
            ['array_data', new ArrayObject(['abc', 'abc']), ['abc', 'abc']],
            //object
            [
                'object_data',
                'aaa',
                (function() {
                    $result = new StdClass();
                    $result->scalar = 'aaa';
                    return $result;
                })()
            ],
            [
                'object_data',
                (function() {
                    $result = new ArrayObject(['aaa', 111]);
                    return $result;
                })(),
                (function() {
                    $result = new ArrayObject(['aaa', 111]);
                    return $result;
                })()
            ],
            [
                'object_data',
                ['aaa', 'bbb' => 111],
                (function() {
                    $result = new StdClass();
                    $result->{0} = 'aaa';
                    $result->bbb = 111;
                    return $result;
                })()
            ],
            //class
            [
                'class_data',
                ['aaa', 'bbb' => 111],
                (function() {
                    $result = new ArrayObject(['aaa', 'bbb' => 111]);
                    return $result;
                })()
            ],
            //iterable
            [
                'iterable_data',
                ['aaa', 'bbb' => 111],
                ['aaa', 'bbb' => 111],
            ],
            [
                'iterable_data',
                new ArrayObject(['aaa', 'bbb' => 111]),
                (function() {
                    $result = new ArrayObject(['aaa', 'bbb' => 111]);
                    return $result;
                })()
            ],
            [
                'iterable_data',
                'aaa',
                (function() {
                    $result = new ArrayObject(['aaa']);
                    return $result;
                })()
            ],
            //parent
            [
                'parent_data',
                'aaa',
                (function() {
                    $result = new StdClass();
                    return $result;
                })()
            ],
            //self
            [
                'self_data',
                ['string_data' => 'aaa'],
                (function() {
                    $result = new CastByPropertyTypeTraitTarget();
                    $this->setPrivateProperty(
                        $result,
                        'string_data',
                        'aaa'
                    );
                    return $result;
                })()
            ],
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
        
        $actual = $this->callPrivateMethod(
            $obj,
            'castByPropertyType',
            [
                $property_name,
                $data
            ]
        );
        
        switch ($property_name) {
            case 'object_data':
            case 'class_data':
            case 'iterable_data':
            case 'parent_data':
            case 'self_data':
                $this->assertEquals($expect, $actual);
                break;
            default:
                $this->assertSame($expect, $actual);
        }
    }
    
    /**
    *
    */
    public function castAggregateToArrayメソッドdataProvider()
    {
        return [
            [
                [
                    'non_data' => 'NON_DATA',
                    'bool_data' => 1,
                    'int_data' => false,
                ],
                (function() {
                    $obj = new CastByPropertyTypeTraitTarget();
                    $this->setPrivateProperty($obj, 'non_data','NON_DATA');
                    $this->setPrivateProperty($obj, 'bool_data',true);
                    $this->setPrivateProperty($obj, 'int_data',0);
                    return $obj;
                })(),
            ],
            [
                [
                    'non_data' => 123,
                    'bool_data' => '',
                    'int_data' => '456',
                    'float_data' => '3.1415',
                    'string_data' => 11,
                ],
                (function() {
                    $obj = new CastByPropertyTypeTraitTarget();
                    $this->setPrivateProperty($obj, 'non_data',123);
                    $this->setPrivateProperty($obj, 'bool_data',false);
                    $this->setPrivateProperty($obj, 'int_data',456);
                    $this->setPrivateProperty($obj, 'float_data',3.1415);
                    $this->setPrivateProperty($obj, 'string_data','11');
                    return $obj;
                })(),
            ],
            
            
            
            
            
            
            
            
        ];
    }
    
    /**
    *   @test
    *   @dataProvider castAggregateToArrayメソッドdataProvider
    */
    public function castAggregateToArrayメソッド(
        $data,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new CastByPropertyTypeTraitTarget($data);
        $this->assertEquals($expect, $obj);
        
        
        var_dump($obj->toArray());
        
        
        //$this->assertEquals($data, $obj->toArray());
    }
}
