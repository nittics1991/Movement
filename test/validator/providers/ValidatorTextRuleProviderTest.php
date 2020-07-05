<?php

declare(strict_types=1);

namespace Movement\test\validator\providers;

use Movement\test\MovementTestCase;
use Movement\validator\providers\ValidatorTextRuleProvider;
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};

class ValidatorTextRuleProviderTest extends MovementTestCase
{
    /**
    *
    */
    public function provider動作dataProvider()
    {
        return [
            ['length', ['ABC', 3], true],
            ['length', ['あいうえお', 5], true],
            ['length', ['ABC', 2], false],
            ['length', ['あいうえお', 4], false],
            
            ['minLength', ['ABC', 3], true],
            ['minLength', ['ABCD', 3], true],
            ['minLength', ['AB', 3], false],
            ['minLength', ['あいう', 3], true],
            ['minLength', ['あいうえ', 3], true],
            ['minLength', ['あい', 3], false],
            
            ['maxLength', ['ABC', 3], true],
            ['maxLength', ['ABCD', 3], false],
            ['maxLength', ['AB', 3], true],
            ['maxLength', ['あいう', 3], true],
            ['maxLength', ['あいうえ', 3], false],
            ['maxLength', ['あい', 3], true],
             
            ['alpha', ['ABcd'], true],
            ['alpha', ['AB8cd'], false],
            
            ['alnum', ['ABcd'], true],
            ['alnum', ['AB8cd'], true],
            ['alnum', ['1234'], true],
            ['alnum', ['1234+'], false],
            
            ['ascii', ['1234+'], true],
            ['ascii', ['12
            34+'], false],
            
            ['hiragana', ['あいう'], true],
            ['hiragana', ['アイウ'], false],
            
            ['katakana', ['アイウ'], true],
            ['katakana', ['あいう'], false],
            
            ['hankana', ['ｱｲｳ'], true],
            ['hankana', ['アイウ'], false],
            
            ['regex', ['bzac', '\A[a-z]*\z'], true],
            ['regex', ['bzAc', '\A[a-z]*\z'], false],

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
            ValidatorTextRuleProvider::class
        );
        
        $callback = $container->get($name);
        
        $this->assertEquals(true, is_callable($callback));
        $this->assertEquals(
            $expect,
            call_user_func_array($callback, $arguments)
        );
    }
}
