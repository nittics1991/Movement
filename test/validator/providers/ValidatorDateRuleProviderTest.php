<?php

declare(strict_types=1);

namespace Movement\test\validator\providers;

use Movement\test\MovementTestCase;
use Movement\validator\providers\ValidatorDateRuleProvider;
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};

class ValidatorDateRuleProviderTest extends MovementTestCase
{
    /**
    *
    */
    public function provider動作dataProvider()
    {
        return [
            ['dateFormat', ['2020-03-01', 'Y-m-d'], true],
            ['dateFormat', ['2021-02-29', 'Y-m-d'], false],
            ['dateFormat', ['20200301', 'Ymd'], true],
            ['dateFormat', ['190301', 'ymd'], true],
            ['dateFormat', ['2021-05', 'Y-m-d'], false],
            ['dateFormat', ['2021-05', 'Y-m'], true],
            ['dateFormat', ['202105', 'Ym'], true],
            ['dateFormat', ['202113', 'Ym'], false],
            ['dateFormat', ['0731', 'md'], true],
            ['dateFormat', ['0229', 'md'], false],
            ['dateFormat', ['21', 'd'], true],
            ['dateFormat', ['32', 'd'], false],
            ['dateFormat', ['20200301_042159', 'Ymd_His'], true],
            ['dateFormat', ['20200301_042159', 'Ymd_His'], true],
            ['dateFormat', ['20200301 0421', 'Ymd Hi'], true],
            ['dateFormat', ['200301 0421', 'ymd Hi'], true],
            
            
            
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
            ValidatorDateRuleProvider::class
        );
        
        $callback = $container->get($name);
        
        $this->assertEquals(true, is_callable($callback));
        $this->assertEquals(
            $expect,
            call_user_func_array($callback, $arguments)
        );
    }
}
