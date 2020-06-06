<?php

declare(strict_types=1);

namespace Moverment\test;

use PHPUnit\Framework\TestCase;
use Moverment\test\PrivateTestTrait;

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
            $obj->callPriveteMethod($target, 'protectedMethod', 'A')
        );
        
        $this->assertEquals(
            'B',
            $obj->callPriveteMethod($target, 'privateMethod', 'B')
        );
        
        $this->assertEquals(
            'protectedProperty',
            $obj->getPriveteProperty($target, 'protected_property')
        );
        
        $this->assertEquals(
            'privateProperty',
            $obj->getPriveteProperty($target, 'private_property')
        );
        
        
        
        
        
        
    }
}
