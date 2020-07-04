<?php

declare(strict_types=1);

namespace Movement\test\validator\providers;

use Movement\test\MovementTestCase;
use Movement\validator\providers\ValidatorBcCompareRuleProvider;
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};

class ValidatorBcCompareRuleProviderTest extends MovementTestCase
{
    /**
    *
    */
    public function provider動作dataProvider()
    {
        return [
            ['equalStrict', [123, 123], true],
            ['equalStrict', [123, 122], false],
            
            ['notEqualStrict', [123, 1234], true],
            ['notEqualStrict', [123, 123], false],
            
            ['greaterStrict', [11, 10], true],
            ['greaterStrict', [11, 11], false],
            
            ['greaterThanStrict', [11, 11], true],
            ['greaterThanStrict', [11, 12], false],
            
            ['lessStrict', [11, 12], true],
            ['lessStrict', [11, 11], false],
            
            ['lessThanStrict', [11, 11], true],
            ['lessThanStrict', [11, 10], false],
            
        ];
    }
    
    /**
    *   @test
    *   @dataProvider provider動作dataProvider
    */
    public function provider動作(
        $name,
        $arguments,
        $expect
    ) {
      //$this->markTestIncomplete();

        $container = new ServiceContainer();
        $serviceProvider = new ServiceProviderContainer();
        $container->delegate($serviceProvider);

        $container->addServiceProvider(
            ValidatorBcCompareRuleProvider::class
        );
        
        $callback = $container->get($name);
        
        $this->assertEquals(true, is_callable($callback));
        $this->assertEquals(
            $expect,
            call_user_func_array($callback, $arguments)
        );
    }
}
