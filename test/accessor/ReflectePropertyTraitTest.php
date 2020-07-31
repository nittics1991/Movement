<?php

declare(strict_types=1);

namespace Movement\test\accessor;

use Movement\test\MovementTestCase;
use Movement\accessor\ReflectePropertyTrait;
use BadMethodCallException;
use InvalidArgumentException;
use ArrayObject;
use StdClass;
use TypeError;

/**
*   ReflectePropertyTraitで操作するクラス
*/
class ReflectePropertyTraitTarget
{
    use ReflectePropertyTrait{
        fromAggregate as public;
    }
    
    public string $public_property = 'publicProperty';
    protected string $protected_property = 'protectedProperty';
    private string $private_property = 'privateProperty';
    
    //unset test用
    public ?string $public_property_null = 'publicPropertyNull';
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
                'public_property_null' => 'public_property_null',
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
        
        $this->assertFalse(
            $obj->has('notdefine_property')
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
        
        $this->assertFalse(
            $obj->isWritable('notdefine_property')
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
        //notdefine_property
        
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
        
        $this->assertFalse(
            isset($obj->notdefine_property)
        );
        
        //__set
        $obj->public_property = 'newPublicProperty';
        $this->assertEquals(
            'newPublicProperty',
            $obj->public_property
        );
        
        //protected_proterty
        //private_proterty
        //notdefine_property
    }
    
    /**
    *   @test
    */
    public function publicメソッドunset_null未定義()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        unset($obj->public_property);
        
        $this->assertFalse(
            isset($obj->public_property)
        );
        $this->assertTrue(
            $obj->has('public_property')
        );
        
        //get
        try {
            $result = $obj->public_property;
            $this->assertEquals(0,1,'unset後に取得は出来てはならない');
        } catch (TypeError $e) {
            $this->assertEquals(1,1);
        }
        
        //set
        try {
            $obj->public_property = 'AAA';
            $this->assertEquals(0,1,'unset後に代入出来てはならない');
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
        }
    }
    
    /**
    *   @test
    */
    public function publicメソッドunset_null定義()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        unset($obj->public_property_null);
        
        $this->assertFalse(
            isset($obj->public_property_null)
        );
        $this->assertTrue(
            $obj->has('public_property_null')
        );
        
        //get
        $this->assertEquals(
            null,
            $obj->public_property_null
        );
        
        //set
        try {
            $obj->public_property_null = 'newPublicPropertyNull';
            $this->assertEquals(0,1,'unset後に代入出来てはならない');
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
        }
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
    public function notdefineプロパティunset例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            unset($obj->notdefine_property);
        } catch (BadMethodCallException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function notdefineプロパティset例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            $obj->notdefine_property = 1;
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function notdefineプロパティget例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        try {
            $val = $obj->notdefine_property;
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
                'public_property_null' => 'publicPropertyNull',
            ],
            $obj->toArray()
        );
    }
    
    /**
    *   @test
    */
    public function fromAggregateメソッドarray()
    {
      //$this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'protected_property' => 'newProtectedProperty',
            'public_property_null' => 'newPublicPropertyNull',
        ];
        
        $obj->fromAggregate($data);
        
        $this->assertSame(
            $data,
            $obj->toArray()
        );
    }
    
    /**
    *   @test
    */
    public function fromAggregateメソッドobject()
    {
      //$this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'protected_property' => 'newProtectedProperty',
            'public_property_null' => 'newPublicPropertyNull',
        ];
        $stdClass = new StdClass();
        
        foreach ($data as $key => $val) {
            $stdClass->$key = $val;
        }
        
        $obj->fromAggregate($stdClass);
        
        $this->assertSame(
            (array)$stdClass,
            $obj->toArray()
        );
    }
    
    /**
    *   @test
    */
    public function fromAggregateメソッドTraversable()
    {
      //$this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'protected_property' => 'newProtectedProperty',
            'public_property_null' => 'newPublicPropertyNull',
        ];
        $arrayObject = new ArrayObject($data);
        
        $obj->fromAggregate($arrayObject);
        
        $this->assertSame(
            (array)$arrayObject,
            $obj->toArray()
        );
    }
    
    /**
    *   @test
    */
    public function fromAggregateプロパティ未定義例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'DUMMY' => 'dummy',
            'protected_property' => 'newProtectedProperty',
            'public_property_null' => 'newPublicPropertyNull',
        ];
        $arrayObject = new ArrayObject($data);
        
        try {
            $obj->fromAggregate($arrayObject);
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function fromAggregatePrivateプロパティ例外()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $data = [
            'public_property' => 'newPublicProperty',
            'private_property' => 'newPrivateProperty',
            'protected_property' => 'newProtectedProperty',
            'public_property_null' => 'newPublicPropertyNull',
        ];
        $arrayObject = new ArrayObject($data);
        
        try {
            $obj->fromAggregate($arrayObject);
        } catch (InvalidArgumentException $e) {
            $this->assertEquals(1,1);
            return;
        }
        $this->assertEquals(1,0);
    }
    
    /**
    *   @test
    */
    public function getPropertiesメソッド()
    {
//      $this->markTestIncomplete();
        
        $obj = new ReflectePropertyTraitTarget();
        
        $expect = [
            'public_property',
            'protected_property',
            'public_property_null',
        ];
        
        $this->assertSame(
            $expect,
            $obj->getProperties()
        );
    }
}
