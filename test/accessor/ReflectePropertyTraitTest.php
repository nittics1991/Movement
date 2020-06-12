<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\ReflectePropertyTrait;

/**
*   ReflectePropertyTraitで操作するクラス
*/
class ReflectePropertyTraitTarget
{
    use ReflectePropertyTrait;
    
    public $public_property = 'publicProperty';
    protected $protected_property = 'protectedProperty';
    private $private_property = 'privateProperty';
}


////////////////////////////////////////////////////////////////////////////////

class ReflectePropertyTraitTest extends MovementTestCase
{
    /**
    *   @test
    */
    public function reflectePropertyメソッド()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $this->callPrivateMethod($obj, 'reflecteProperty', []);
        
        $properties = $this->getPrivateProperty($obj, 'properties');
        
        $actual = array_map(
            function($reflectionProperty) {
                return $reflectionProperty->getName();
            },
            $properties
        );
        
        $this->assertSame(
            [
                'public_property' => 'public_property',
                'protected_property' => 'protected_property',
            ],
            $actual
        );
    }
    
    /**
    *   @test
    */
    public function hasメソッド()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $this->assertTrue(
            $obj->has('public_property')
        );
        
        $this->assertTrue(
            $obj->has('protected_property')
        );
        
        $this->assertFalse(
            $obj->has('private_property')
        );
    }
    
    /**
    *   @test
    */
    public function isWritableメソッド()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $this->assertTrue(
            $obj->isWritable('public_property')
        );
        
        $this->assertFalse(
            $obj->isWritable('protected_property')
        );
        
        $this->assertFalse(
            $obj->isWritable('private_property')
        );
    }
    
    /**
    *   @test
    */
    public function マジックメソッド()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        //__get
        $this->assertEquals(
            'publicProperty',
            $obj->public_property
        );
        
        $this->assertEquals(
            'protectedProperty',
            $obj->protected_property
        );
        
        //__isset
        $this->assertTrue(
            isset($obj->public_property)
        );
        
        $this->assertTrue(
            isset($obj->protected_property)
        );
        
        //__set
        $obj->public_property = 'newPublicProperty';
        $this->assertEquals(
            'newPublicProperty',
            $obj->public_property
        );
        
        //__unset
        //public_propertyは__unsetを呼び出さないのでpropertiesは変わらない
        unset($obj->public_property);
        
        try {
            $this->getPrivateProperty($obj, 'public_property');
        } catch (Throwable $e) {
            var_dump($e);
        }
        
        
    }
    
    
}
