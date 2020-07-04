<?php

declare(strict_types=1);

namespace Movement\test\validator;

use Movement\test\MovementTestCase;
use Movement\validator\AbstractValidatorRuleProvider;

/**
*   AbstractValidatorRuleProviderでを実装するクラス
*/
class AbstractValidatorRuleProviderTarget extends
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
            
            
            
        ];
    }
}

////////////////////////////////////////////////////////////////////////////////

class AbstractValidatorRuleProviderTest extends MovementTestCase
{
    /**
    *
    */
    public function providesプロパティ設定dataProvider()
    {
        return [
            [['is_bool', 'isInt', 'isFloat']],
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
            [
                
            ],
        ];
    }
    
    /**
    *   @test
    *   @dataProvider registerメソッドdataProvider
    */
    public function registerメソッド(
        $name,
        $expect
    ) {
      //$this->markTestIncomplete();

        $obj = new AbstractValidatorRuleProviderTarget();
        $obj->register();
        
        $this->assertEquals(
            $expect,
            $obj->get($name)
        );
    }
}
