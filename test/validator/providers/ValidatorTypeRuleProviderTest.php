<?php

declare(strict_types=1);

namespace Movement\test\validator\providers;

use Movement\test\MovementTestCase;
use Movement\validator\providers\ValidatorTypeRuleProvider;
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};
use StdClass;

class ValidatorTypeRuleProviderTest extends MovementTestCase
{
    /**
    *
    */
    public function registerメソッドdataProvider()
    {
        return [
            ['isArray', [[123]], true],
            ['isArray', [123], false],
            ['isBool', [true], true],
            ['isBool', [0], false],
            ['isCallable', ['is_callable'], true],
            ['isCallable', ['dummy'], false],
            ['isCountable', [[123]], true],
            ['isCountable', [123], false],
            ['isFloat', [123.4], true],
            ['isFloat', [123], false],
            ['isInt', [123], true],
            ['isInt', ['123'], false],
            ['isNull', [null], true],
            ['isNull', [0], false],
            ['isNumeric', [123.4], true],
            ['isNumeric', ['abc'], false],
            ['isObject', [new StdClass()], true],
            ['isObject', [0], false],
            ['isResource', [tmpfile()], true],
            ['isResource', [0], false],
            ['isScalar', [true], true],
            ['isScalar', [new StdClass()], false],
            ['isString', ['123'], true],
            ['isString', [123], false],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider registerメソッドdataProvider
    */
    public function registerメソッド(
        $name,
        $arguments,
        $expect
    ) {
      //$this->markTestIncomplete();

        $container = new ServiceContainer();
        $serviceProvider = new ServiceProviderContainer();
        $container->delegate($serviceProvider);

        $container->addServiceProvider(
            ValidatorTypeRuleProvider::class
        );
        
        $callback = $container->get($name);
        
        $this->assertEquals(true, is_callable($callback));
        $this->assertEquals(
            $expect,
            call_user_func_array($callback, $arguments)
        );
    }
}
