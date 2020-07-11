<?php

declare(strict_types=1);

namespace Movement\test\validator;

use Movement\test\MovementTestCase;
use Movement\validator\AbstractValidatorRuleProvider;
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};

/**
*   AbstractValidatorRuleProviderでを実装するクラス
*/
class ValidatorRuleDefinedTest extends
    AbstractValidatorRuleProvider
{
    protected function setRules()
    {
        $this->rules = [
            'is_bool' => 'is_bool',
            'isInt' => fn($v) => is_int($v),
            'isFloat' => function($val, $params = []) {
                $result = is_float($val);
                
                if (isset($params[0])) {
                    $result = $result && $val >= $params[0];
                }
                
                if (isset($params[1])) {
                    $result = $result && $val <= $params[1];
                }
                return $result;
            },
            'isText' => [$this, 'isText'],
        ];
    }
    
    /**
    *
    */
    public function isText($val, $params = [])
    {
        $result = is_string($val);
        
        if (isset($params[0])) {
            $result = $result && strlen($val) >= $params[0];
        }
        
        if (isset($params[1])) {
            $result = $result && strlen($val) <= $params[1];
        }
        return $result;
    }
}

////////////////////////////////////////////////////////////////////////////////

class ValidatorRuleDefinedTest extends MovementTestCase
{
    /**
    *
    */
    public function providesプロパティ設定dataProvider()
    {
        return [
            [['is_bool', 'isInt', 'isFloat', 'isText']],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider providesプロパティ設定dataProvider
    */
    public function providesプロパティ設定(
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new AbstractValidatorRuleProviderTarget();
        
        $this->assertEquals(
            $expect,
            $this->getPrivateProperty(
                $obj,
                'provides'
            )
        );
    }
    
    /**
    *
    */
    public function registerメソッドdataProvider()
    {
        return [
            ['is_bool', [true], true],
            ['is_bool', [0], false],
            ['isInt', [123], true],
            ['isInt', ['123'], false],
            ['isFloat', [123.4], true],
            ['isFloat', [123], false],
            ['isFloat', [123.4, [100]], true],
            ['isFloat', [123.4, [200]], false],
            ['isFloat', [123.4, [100, 200]], true],
            ['isFloat', [123.4, [100, 110]], false],
            ['isText', ['123'], true],
            ['isText', [123], false],
            ['isText', ['123', [2]], true],
            ['isText', ['123', [4]], false],
            ['isText', ['123', [2, 3]], true],
            ['isText', ['123', [1, 2]], false],
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
            AbstractValidatorRuleProviderTarget::class
        );
        
        $callback = $container->get($name);
        
        $this->assertEquals(true, is_callable($callback));
        $this->assertEquals(
            $expect,
            call_user_func_array($callback, $arguments)
        );
    }
}
