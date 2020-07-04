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
    public function provider動作dataProvider()
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
            
            ['isNotArray', [[123]], false],
            ['isNotArray', [123], true],
            ['isNotBool', [false], false],
            ['isNotBool', [0], true],
            ['isNotCallable', ['is_callable'], false],
            ['isNotCallable', ['dummy'], true],
            ['isNotCountable', [[123]], false],
            ['isNotCountable', [123], true],
            ['isNotFloat', [123.4], false],
            ['isNotFloat', [123], true],
            ['isNotInt', [123], false],
            ['isNotInt', ['123'], true],
            ['isNotNull', [null], false],
            ['isNotNull', [0], true],
            ['isNotNumeric', [123.4], false],
            ['isNotNumeric', ['abc'], true],
            ['isNotObject', [new StdClass()], false],
            ['isNotObject', [0], true],
            ['isNotResource', [tmpfile()], false],
            ['isNotResource', [0], true],
            ['isNotScalar', [false], false],
            ['isNotScalar', [new StdClass()], true],
            ['isNotString', ['123'], false],
            ['isNotString', [123], true],
            
            ['isTrue', [true], true],
            ['isTrue', [false], false],
            ['isFalse', [false], true],
            ['isFalse', [true], false],
            ['isEmpty', [0], true],
            ['isEmpty', [1], false],
            ['isNotEmpty', ['A'], true],
            ['isNotEmpty', [''], false],
            ['isBlank', [''], true],
            ['isBlank', [1], false],
            ['isNotBlank', ['A'], true],
            ['isNotBlank', [''], false],
            
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
