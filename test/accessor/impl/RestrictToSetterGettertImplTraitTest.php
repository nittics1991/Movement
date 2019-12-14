<?php

declare(strict_types=1);

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\ConcertoTestCase;
use Movement\accessor\impl\RestrictToSetterGettertImplTrait;
use Movement\accessor\GetterInterface;
use Movement\accessor\SetterInterface;
use Movement\accessor\AttributeInterface;

class TestRestrictToSetterGettertImplTrait1 implements
    GetterInterface,
    SetterInterface,
    AttributeInterface
{
    use RestrictToSetterGettertImplTrait;
    
    protected $propertyDefinitions = [
        'prop_b', 'prop_i', 'prop_f', 'prop_s', 'prop_a', 'prop_o', 'both',
    ];
    
    protected $getterDefinitions = [
        'prop_b', 'prop_i', 'prop_f', 'both',
    ];
    
    protected $setterDefinitions = [
        'prop_s', 'prop_a', 'prop_o', 'both'
    ];
}

class RestrictToSetterGettertImplTraitTest extends MovementTestCase
{
    /**
    *   @test
    */
    public function basicSuccess()
    {
//      $this->markTestIncomplete();
        
        $obj = new TestRestrictToSetterGettertImplTrait1();
        
        //setter
        $obj->setProp_s(123);
        $expect = $this->getPrivateProperty($obj, 'dataContainer');
        $this->assertEquals(123, $expect['prop_s']);
        //getter
        $this->setPrivateProperty($obj, 'dataContainer', ['prop_f' => 999.9]);
        $this->assertEquals(999.9, $obj->getProp_f());
    }
    
    /**
    *   @test
    */
    public function getterException()
    {
        // $this->markTestIncomplete();
        
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('must be use getter method');
        
        $obj = new TestRestrictToSetterGettertImplTrait1();
        $expect = $obj->prop_i;
    }
    
    /**
    *   @test
    */
    public function setterException()
    {
        // $this->markTestIncomplete();
        
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('must be use setter method');
        
        $obj = new TestRestrictToSetterGettertImplTrait1();
        $obj->prop_s = 123;
    }
    
    /**
    *   @test
    */
    public function unsetException()
    {
        // $this->markTestIncomplete();
        
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('must be use setter method');
        
        $obj = new TestRestrictToSetterGettertImplTrait1();
        unset($obj->prop_s);
    }
}
