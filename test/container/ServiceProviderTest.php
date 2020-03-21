<?php

declare(strict_types=1);

namespace Concerto\test\container;

use Concerto\test\ConcertoTestCase;
use Concerto\container\ServiceContainer;
use Concerto\container\exception\NotFoundException;
use Concerto\container\ReflectionContainer;
use Concerto\container\ServiceProviderContainer;
use Concerto\test\container\TestClassHasDependencies;
use Concerto\test\container\TestClassMixReflectionAndProvider;
use Concerto\test\container\TestServiceProvider41;

class ServiceProviderTest extends ConcertoTestCase
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
        $this->assertEquals(true, ($ArrayObject = $container->get(\ArrayObject::class)) instanceof \ArrayObject);
        $this->assertEquals(range(1, 10), iterator_to_array ($ArrayObject));
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
        $this->assertEquals(true, ($ArrayObject = $container->get(\ArrayObject::class)) instanceof \ArrayObject);
        $this->assertEquals(range(1, 10), iterator_to_array ($ArrayObject));
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
