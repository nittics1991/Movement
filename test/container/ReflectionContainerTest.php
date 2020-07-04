<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\test\MovementTestCase;
use Movement\container\ServiceContainer;
use Movement\container\exception\NotFoundException;
use Movement\container\ReflectionContainer;
use Movement\container\ServiceProviderContainer;
use Movement\test\container\TestClassHasDependencies;

class ReflectionContainerTest extends MovementTestCase
{
    /**
    *   @test
    **/
    public function reflectClassAndConstructorClassParameter()
    {
//      $this->markTestIncomplete();
        
        //no reflection
        $container = new ServiceContainer();
        $this->assertEquals(false, $container->has(TestClassHasDependencies::class));
        
        //reflectionで自動bind
        //same:new TestClassHasDependencies(StdClass)
        //引数もclassなら自動解決
        $container->delegate(new ReflectionContainer());
        
        $this->assertEquals(true, $container->has(TestClassHasDependencies::class));
        $this->assertEquals(
            true,
            $container->get(TestClassHasDependencies::class)->argument instanceof \StdClass
        );
    }
    
    /**
    *   @test
    **/
    public function failureReflectClassNotDefaultValue()
    {
//      $this->markTestIncomplete();
        
        //no reflection
        $container = new ServiceContainer();
        $this->assertEquals(false, $container->has(\DateTime::class));
        
        $container->delegate(new ReflectionContainer());
        $this->assertEquals(true, $container->has(\DateTime::class));
        
        //default valueがclassでないから解決できない
        try {
            $obj = null;
            $obj = $container->get(\DateTime::class);
        } catch (\Exception $e) {
            $this->assertEquals(null, $obj);
        }
    }
}
