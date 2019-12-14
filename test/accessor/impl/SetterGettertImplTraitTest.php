<?php

declare(strict_types=1);

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\ConcertoTestCase;
use Movement\accessor\impl\SetterGettertImplTrait;
use Movement\accessor\GetterInterface;
use Movement\accessor\SetterInterface;

class TestSetterGettertImplTrait1 implements
    SetterInterface,
    GetterInterface
{
    use SetterGettertImplTrait;
    
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

class SetterGettertImplTraitTest extends MovementTestCase
{
    /**
    *   @test
    */
    public function basicSuccess()
    {
//      $this->markTestIncomplete();
        
        $obj = new TestSetterGettertImplTrait1();
        
        //setter
        $obj->setProp_s(123);
        $this->assertEquals(123, $obj->prop_s);
        //getter
        $obj->prop_i = 999.9;
        $this->assertEquals(999.9, $obj->getProp_i());
    }
    
    /**
    *   @test
    */
    public function getterException()
    {
        // $this->markTestIncomplete();
        
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('not defined method:getDummy');
        
        $obj = new TestSetterGettertImplTrait1();
        $obj->getDummy();
    }
    
    /**
    *   @test
    */
    public function setterException()
    {
        // $this->markTestIncomplete();
        
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('not defined method:setDummy');
        
        $obj = new TestSetterGettertImplTrait1();
        $obj->setDummy(123);
    }
}
