<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\ReflectePropertyTrait;
use BadMethodCallException;
use InvalidArgumentException;
use ArrayObject;

/**
*   ReflectePropertyTraitで操作するクラス
*/
class ReflectePropertyTraitTarget
{
    use ReflectePropertyTrait{
        fromIterable as public;
    }
    
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
        
        //private_proterty
        
        //__isset
        $this->assertTrue(
            isset($obj->public_property)
        );
        
        $this->assertTrue(
            isset($obj->protected_property)
        );
        
        $this->assertFalse(
            isset($obj->private_proterty)
        );
        
        //__set
        $obj->public_property = 'newPublicProperty';
        $this->assertEquals(
            'newPublicProperty',
            $obj->public_property
        );
        
        //protected_proterty
        //private_proterty
        
        //__unset
        unset($obj->public_property);
        $this->assertEquals(
            null,
            $obj->public_property
        );
        $this->assertFalse(
            isset($obj->public_property)
        );
        $this->assertTrue(
            $obj->has('public_property')
        );
        
        //protected_proterty
        //private_proterty
    }
    
    /**
    *   @test
    *   @expectedException BadMethodCallException
    */
    public function 例外アノテーション動かない()
    {
      $this->markTestIncomplete('Incomplete:例外アノテーション動かない');
        
        $obj = new ReflectePropertyTraitTarget();
        unset($obj->protected_property);
    }
    
    /**
    *   @test
    */
    public function protectedプロパティunset例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            unset($obj->protected_property);
        } catch (BadMethodCallException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function protectedプロパティset例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            $obj->protected_property = 1;
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function privateプロパティunset例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            unset($obj->private_property);
        } catch (BadMethodCallException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function privateプロパティset例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            $obj->private_property = 1;
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function privateプロパティget例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            $val = $obj->private_property;
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function toArrayメソッドarray()
    {
      //$this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $this->assertSame(
            [
                'public_property' => 'publicProperty',
                'protected_property' => 'protectedProperty',
            ],
            $obj->toArray()
        );
    }
    
    /**
    *   @test
    */
    public function fromIterableメソッドarray()
    {
      //$this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'protected_property' => 'newProtectedProperty',
        ];
        
        $obj->fromIterable($data);
        
        $this->assertSame(
            $data,
            $obj->toArray()
        );
    }
    
    /**
    *   @test
    */
    public function fromIterableメソッドobject()
    {
      //$this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'protected_property' => 'newProtectedProperty',
        ];
        $arrayObject = new ArrayObject($data);
        
        $obj->fromIterable($arrayObject);
        
        $this->assertSame(
            (array)$arrayObject,
            $obj->toArray()
        );
    }
    
    /**
    *   @test
    */
    public function fromIterableプロパティ未定義例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'DUMMY' => 'dummy',
            'protected_property' => 'newProtectedProperty',
        ];
        $arrayObject = new ArrayObject($data);
        
        try {
            $obj->fromIterable($arrayObject);
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function fromIterablePrivateプロパティ例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'private_property' => 'newPrivateProperty',
            'protected_property' => 'newProtectedProperty',
        ];
        $arrayObject = new ArrayObject($data);
        
        try {
            $obj->fromIterable($arrayObject);
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
}
