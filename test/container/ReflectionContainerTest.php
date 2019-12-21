<?php

declare(strict_types=1);

namespace Concerto\test\container;

use Concerto\test\ConcertoTestCase;
use Concerto\container\ServiceContainer;
use Concerto\container\exception\NotFoundException;
use Concerto\container\ReflectionContainer;
use Concerto\container\ServiceProviderContainer;
use Concerto\test\container\TestClassHasDependencies;

class ReflectionContainerTest extends ConcertoTestCase
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
