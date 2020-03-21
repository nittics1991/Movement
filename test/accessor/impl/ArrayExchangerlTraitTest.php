<?php

declare(strict_types=1);
declare(strict_types=1);

namespace Concerto\test\accessor\impl;

use Concerto\test\ConcertoTestCase;
use Concerto\accessor\impl\ArrayExchangerTrait;
use Concerto\accessor\ToArrayInterface;

class TestArrayExchangerlTrait1 implements
    ToArrayInterface
{
    use ArrayExchangerTrait;
    
    protected $propertyDefinitions = [
        'prop_b', 'prop_i', 'prop_f', 'prop_s', 'prop_a', 'prop_o',
    ];
}

class ArrayExchangerlTraitTest extends ConcertoTestCase
{
    /**
    *   @test
    */
    public function basicSuccess()
    {
//      $this->markTestIncomplete();
        
        $obj = new TestArrayExchangerlTrait1();
        
        $data = [
                'prop_i' => 123,
                'prop_f' => 999.9,
        ];
        $actual = [
            'prop_b' => null,
            'prop_i' => 123,
            'prop_f' => 999.9,
            'prop_s' => null,
            'prop_a' => null,
            'prop_o' => null,
        ];
        $obj->fromArray($data);
        $this->assertEquals($actual, $obj->toArray());
        
        $data = [
            'prop_i' => 456,
            'prop_s' => 'string',
        ];
        $actual = [
            'prop_b' => null,
            'prop_i' => 456,
            'prop_f' => 999.9,
            'prop_s' => 'string',
            'prop_a' => null,
            'prop_o' => null,
        ];
        $obj->fromArray($data);
        $this->assertEquals($actual, $obj->toArray());
    }
}
