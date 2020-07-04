<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\test\MovementTestCase;
use Movement\container\ServiceContainer;
use Movement\container\exception\NotFoundException;
use Movement\container\ReflectionContainer;
use Movement\container\ServiceProviderContainer;
use Movement\test\container\TestClassHasDependencies;
use Movement\test\container\TestClassMixReflectionAndProvider;
use Movement\test\container\TestServiceProvider41;

class ServiceProviderTest extends MovementTestCase
{
    /**
    *   @test
    **/
    public function concatenateMultipleBindInServiceProvider()
    {
//      $this->markTestIncomplete();
        
        $container = new ServiceContainer();
        $serviceProvider = new ServiceProviderContainer();
        $container->delegate($serviceProvider);
        
        $container->addServiceProvider(TestServiceProvider2::class);
        $this->assertEquals(
            true, 
            ($ar = $container->get(\ArrayObject::class)) instanceof \ArrayObject
        );
        
        $this->assertEquals(
            new \ArrayObject(
                ['sqlite::memory:', 'select * from table']
            ),
            $ar
        );
    }
    
    /**
    *   @test
    **/
    public function bootOfServiceProvider()
    {
//      $this->markTestIncomplete();
        
        $container = new ServiceContainer();
        $serviceProvider = new ServiceProviderContainer();
        $container->delegate($serviceProvider);
        
        $container->addServiceProvider(TestServiceProvider31::class);
        $container->addServiceProvider(TestServiceProvider32::class);
        $container->bootServiceProviders();
        $this->assertEquals(
            true, 
            ($ar = $container->get(\ArrayObject::class)) instanceof \ArrayObject
        );
        
        $this->assertEquals(
            new \ArrayObject(
                ['sqlite::memory:', 'select * from table']
            ),
            $ar
        );
    }
    
    /**
    *   @test
    **/
    public function mixReflectionAndProvider()
    {
//      $this->markTestIncomplete();
        
        //only reflection
        $container = new ServiceContainer();
        $container->delegate(new ReflectionContainer());
        $this->assertEquals(
            true,
            $container->get(TestClassMixReflectionAndProvider::class)
                instanceof TestClassMixReflectionAndProvider
        );
        
        //only provider
        $container = new ServiceContainer();
        $container->delegate(new ServiceProviderContainer());
        $container->addServiceProvider(TestServiceProvider41::class);
        $this->assertEquals(
            true,
            $container->get(TestClassMixReflectionAndProvider::class)
                instanceof TestClassMixReflectionAndProviderOther
        );
        
        //reflection and provider
        //overwite provider, but not call
        $container = new ServiceContainer();
        $container->delegate(new ReflectionContainer());
        $container->delegate(new ServiceProviderContainer());
        $container->addServiceProvider(TestServiceProvider41::class);
        
        $this->assertEquals(
            false,
            $container->get(TestClassMixReflectionAndProvider::class)
                instanceof TestClassMixReflectionAndProviderOther
        );
        
        //reflection and provider
        //extend provider by boot, but not call
        $container = new ServiceContainer();
        $container->delegate(new ReflectionContainer());
        $container->delegate(new ServiceProviderContainer());
        $container->addServiceProvider(TestServiceProvider41::class);
        
        $this->assertEquals(
            false,
            $container->get(TestClassMixReflectionAndProvider::class)
                instanceof TestClassMixReflectionAndProviderOther
        );
    }
}
