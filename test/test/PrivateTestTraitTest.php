<?php

declare(strict_types=1);

namespace Movement\test\test;

use PHPUnit\Framework\TestCase;
use Movement\test\PrivateTestTrait;

class TestPrivateTestTrait
{
    use PrivateTestTrait;
}

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





////////////////////////////////////////////////////////////////////////////////

class PrivateTestTraitTest extends TestCase
{
    /**
    *   @test
    */
    public function privateTestTraitTarget1()
    {
//      $this->markTestIncomplete();
        
        $obj = new TestPrivateTestTrait();
        $target = new PrivateTestTraitTarget1();
        
        $this->assertEquals(
            'A',
            $obj->callPrivateMethod($target, 'protectedMethod', ['A'])
        );
        
        $this->assertEquals(
            'B',
            $obj->callPrivateMethod($target, 'privateMethod', ['B'])
        );
        
        $this->assertEquals(
            'protectedProperty',
            $obj->getPrivateProperty($target, 'protected_property')
        );
        
        $this->assertEquals(
            'privateProperty',
            $obj->getPrivateProperty($target, 'private_property')
        );
    }
}
