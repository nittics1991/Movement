<?php

declare(strict_types=1);

namespace Movement\test\test;

use PHPUnit\Framework\TestCase;
use Movement\test\PrivateTestTrait;

/**
*   PrivateTestTraitを利用するクラス
*/
class TestPrivateTestTrait
{
    use PrivateTestTrait;
}

/**
*   PrivateTestTraitで操作するクラス
*/
class PrivateTestTraitTarget1
{
    protected $protected_property = 'protectedProperty';
    private $private_property = 'privateProperty';
    
    protected function protectedMethod($atguments)
    {
        return $atguments;
    }
    
    private function privateMethod($atguments)
    {
        return $atguments;
    }
}

/**
*   PrivateTestTraitで操作するクラス(継承)
*/
class PrivateTestTraitTarget2 extends PrivateTestTraitTarget1
{
    protected $child_protected_property = 'childProtectedProperty';
    private $child_private_property = 'childPrivateProperty';
    
    protected function childProtectedMethod($atguments)
    {
        return "child={$atguments}";
    }
    
    private function childPrivateMethod($atguments)
    {
        return "child={$atguments}";
    }
}


////////////////////////////////////////////////////////////////////////////////

class PrivateTestTraitTest extends TestCase
{
    /**
    *   @test
    */
    public function 基本的なクラス()
    {
//      $this->markTestIncomplete();
        
        $obj = new TestPrivateTestTrait();
        $target = new PrivateTestTraitTarget1();
        
        //call
        $this->assertEquals(
            'A',
            $obj->callPrivateMethod($target, 'protectedMethod', ['A'])
        );
        
        $this->assertEquals(
            'B',
            $obj->callPrivateMethod($target, 'privateMethod', ['B'])
        );
        
        //get
        $this->assertEquals(
            'protectedProperty',
            $obj->getPrivateProperty($target, 'protected_property')
        );
        
        $this->assertEquals(
            'privateProperty',
            $obj->getPrivateProperty($target, 'private_property')
        );
        
        //set
        $obj->setPrivateProperty(
            $target,
            'protected_property',
            'newProtectedProperty'
        );
        
        $this->assertEquals(
            'newProtectedProperty',
            $obj->getPrivateProperty($target, 'protected_property')
        );
        
        $obj->setPrivateProperty(
            $target,
            'private_property',
            'newPrivateProperty'
        );
        
        $this->assertEquals(
            'newPrivateProperty',
            $obj->getPrivateProperty($target, 'private_property')
        );
    }
    
    /**
    *   @test
    */
    public function 継承した親()
    {
//      $this->markTestIncomplete();
        
        $obj = new TestPrivateTestTrait();
        $target = new PrivateTestTraitTarget2();
        
        //call
        $this->assertEquals(
            'A',
            $obj->callPrivateMethod($target, 'protectedMethod', ['A'])
        );
        
        $this->assertEquals(
            'B',
            $obj->callPrivateMethod($target, 'privateMethod', ['B'])
        );
        
        //get
        $this->assertEquals(
            'protectedProperty',
            $obj->getPrivateProperty($target, 'protected_property')
        );
        
        $this->assertEquals(
            'privateProperty',
            $obj->getPrivateProperty($target, 'private_property')
        );
        
        //set
        $obj->setPrivateProperty(
            $target,
            'protected_property',
            'newProtectedProperty'
        );
        
        $this->assertEquals(
            'newProtectedProperty',
            $obj->getPrivateProperty($target, 'protected_property')
        );
        
        $obj->setPrivateProperty(
            $target,
            'private_property',
            'newPrivateProperty'
        );
        
        $this->assertEquals(
            'newPrivateProperty',
            $obj->getPrivateProperty($target, 'private_property')
        );
    }
    
    /**
    *   @test
    */
    public function 子クラス()
    {
//      $this->markTestIncomplete();
        
        $obj = new TestPrivateTestTrait();
        $target = new PrivateTestTraitTarget2();
        
        //call
        $this->assertEquals(
            'child=A',
            $obj->callPrivateMethod($target, 'childProtectedMethod', ['A'])
        );
        
        $this->assertEquals(
            'child=B',
            $obj->callPrivateMethod($target, 'childPrivateMethod', ['B'])
        );
        
        //get
        $this->assertEquals(
            'childProtectedProperty',
            $obj->getPrivateProperty($target, 'child_protected_property')
        );
        
        $this->assertEquals(
            'childPrivateProperty',
            $obj->getPrivateProperty($target, 'child_private_property')
        );
        
        //set
        $obj->setPrivateProperty(
            $target,
            'child_protected_property',
            'newProtectedProperty'
        );
        
        $this->assertEquals(
            'newProtectedProperty',
            $obj->getPrivateProperty($target, 'child_protected_property')
        );
        
        $obj->setPrivateProperty(
            $target,
            'child_private_property',
            'newPrivateProperty'
        );
        
        $this->assertEquals(
            'newPrivateProperty',
            $obj->getPrivateProperty($target, 'child_private_property')
        );
    }
}
