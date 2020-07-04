<?php

declare(strict_types=1);

namespace Movement\test\validator\providers;

use Movement\test\MovementTestCase;
use Movement\validator\providers\ValidatorCompareRuleProvider;
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};

class ValidatorCompareRuleProviderTest extends MovementTestCase
{
    /**
    *
    */
    public function provider動作dataProvider()
    {
        return [
            ['same', [123, 123], true],
            ['same', ['123', 123], false],
            ['same', [['a' => 1, 'b' => 2], ['a' => 1, 'b' => 2,]], true],
            ['same', [['a' => 1, 'b' => 2], ['b' => 2, 'a' => 1,]], false],

            ['notSame', ['123', 123], true],
            ['notSame', [123, 123], false],
            ['notSame', [['a' => 1, 'b' => 2], ['b' => 2, 'a' => 1,]], true],
            ['notSame', [['a' => 1, 'b' => 2], ['a' => 1, 'b' => 2,]], false],
            
            ['equal', ['123', 123], true],
            ['equal', ['123', 1234], false],
            ['equal', [['a' => 1, 'b' => 2], ['b' => 2, 'a' => 1,]], true],
            ['equal', [['a' => 1, 'b' => 2], ['b' => 2, 'a' => 1, 4,]], false],
            
            ['notEqual', ['123', 1234], true],
            ['notEqual', ['123', 123], false],
            ['notEqual', [['a' => 1, 'b' => 2], ['b' => 2, 'a' => 1, 4,]], true],
            ['notEqual', [['a' => 1, 'b' => 2], ['b' => 2, 'a' => 1,]], false],
            
            ['greater', [11, 10], true],
            ['greater', [11, 11], false],
            ['greater', ['m', 'l'], true],
            ['greater', ['m', 'm'], false],
            
            ['greaterThan', [11, 11], true],
            ['greaterThan', [11, 12], false],
            ['greaterThan', ['m', 'm'], true],
            ['greaterThan', ['m', 'n'], false],
            
            ['less', [11, 12], true],
            ['less', [11, 11], false],
            ['less', ['m', 'n'], true],
            ['less', ['m', 'm'], false],
            
            ['lessThan', [11, 11], true],
            ['lessThan', [11, 10], false],
            ['lessThan', ['m', 'm'], true],
            ['lessThan', ['m', 'l'], false],
            
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
            ValidatorCompareRuleProvider::class
        );
        
        $callback = $container->get($name);
        
        $this->assertEquals(true, is_callable($callback));
        $this->assertEquals(
            $expect,
            call_user_func_array($callback, $arguments)
        );
    }
}
