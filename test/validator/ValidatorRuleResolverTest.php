<?php

declare(strict_types=1);

namespace Movement\test\validator;

use Movement\test\MovementTestCase;
use Movement\validator\providers\{
    ValidatorBcCompareRuleProvider,
    ValidatorCompareRuleProvider,
    ValidatorDateRuleProvider,
    ValidatorMathRuleProvider,
    ValidatorTextRuleProvider,
    ValidatorTypeRuleProvider
};
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};
use Movement\validator\ValidatorRuleResolver;

class ValidatorRuleResolverTest extends MovementTestCase
{
    protected function setUp(): void
    {
        $providers = [
            ValidatorBcCompareRuleProvider::class,
            ValidatorCompareRuleProvider::class,
            ValidatorDateRuleProvider::class,
            ValidatorMathRuleProvider::class,
            ValidatorTextRuleProvider::class,
            ValidatorTypeRuleProvider::class,
        ];
        
        $container = new ServiceContainer();
        $serviceProvider = new ServiceProviderContainer();
        $container->delegate($serviceProvider);
        
        foreach ($providers as $provider) {
            $container->addServiceProvider($provider);
        }
        $this->obj = new ValidatorRuleResolver($container);
    }
    
    /**
    *
    */
    public function repairEscapeCharactersメソッドdataProvider()
    {
        return [
            [
                ['between', '20', '30'],  //区切り文字「:」なし
                ':',
                ['between', '20', '30'],
            ],
            //実際は「:」でsplit後に実行する処理なので、
            //ここでは//=>:に置換するが
            //$functionに文字列「:」は出てこないはず
            [
                ['regex', '^[A-Z#\\', ':%]'],
                ':',
                ['regex', '^[A-Z#::%]'],
            ],
            [
                ['regex', '^[A-Z#\\', '%]'],    //区切り文字「:」でsplitされた時   
                ':',
                ['regex', '^[A-Z#:%]'],
            ],
             [
                ['regex', '^[A-Z#\\', '%\\]'],  //最後の文字「\」
                ':',
                ['regex', '^[A-Z#:%\\]'],
            ],
             [
                ['regex', '\\[A-Z#\\', '%]'],  //最初の文字「\」
                ':',
                ['regex', '\\[A-Z#:%]'],
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider repairEscapeCharactersメソッドdataProvider
    */
    public function repairEscapeCharactersメソッド(
        $function,
        $character,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = $this->obj;
        
        $actual = $this->callPrivateMethod(
            $this->obj,
            'repairEscapeCharacters',
            [$function, $character]
        );
        
        $this->assertEquals($expect, $actual);
    }
}
