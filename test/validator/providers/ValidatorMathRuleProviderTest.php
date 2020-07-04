<?php

declare(strict_types=1);

namespace Movement\test\validator\providers;

use Movement\test\MovementTestCase;
use Movement\validator\providers\ValidatorMathRuleProvider;
use Movement\container\{
    ServiceContainer,
    ServiceProviderContainer
};

class ValidatorMathRuleProviderTest extends MovementTestCase
{
    /**
    *
    */
    public function provider動作dataProvider()
    {
        return [
            ['isNan', [NAN], true],
            ['isNan', ['123'], false],
            
            ['isNotNan', ['123'], true],
            ['isNotNan', [NAN], false],
            
            ['isFinite', [123], true],
            ['isFinite', [INF], false],
            
            ['isInfinite', [INF], true],
            ['isInfinite', [123], false],
            
            ['positive', [1], true],
            ['positive', [0], false],
            
            ['positiveOrZero', [0], true],
            ['positiveOrZero', [-1], false],
            
            ['negative', [-1], true],
            ['negative', [0], false],
            
            ['negativeOrZero', [0], true],
            ['negativeOrZero', [1], false],
            
            ['between', [12, 11, 13], true],
            ['between', [11, 11, 13], true],
            ['between', [13, 11, 13], true],
            ['between', [10, 11, 13], false],
            ['between', [14, 11, 13], false],
            
            ['overlap', [12, 11, 13], true],
            ['overlap', [11, 11, 13], true],
            ['overlap', [13, 11, 13], false],
            ['overlap', [10, 11, 13], false],
            ['overlap', [14, 11, 13], false],
            
            ['inner', [12, 11, 13], true],
            ['inner', [11, 11, 13], false],
            ['inner', [13, 11, 13], false],
            ['inner', [10, 11, 13], false],
            ['inner', [14, 11, 13], false],
            
            ['outer', [12, 11, 13], false],
            ['outer', [11, 11, 13], false],
            ['outer', [13, 11, 13], false],
            ['outer', [10, 11, 13], true],
            ['outer', [14, 11, 13], true],
            
            ['min', [12, 12], true],
            ['min', [13, 12], true],
            ['min', [11, 12], false],
            
            ['max', [12, 12], true],
            ['max', [11, 12], true],
            ['max', [13, 12], false],
            
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
            ValidatorMathRuleProvider::class
        );
        
        $callback = $container->get($name);
        
        $this->assertEquals(true, is_callable($callback));
        $this->assertEquals(
            $expect,
            call_user_func_array($callback, $arguments)
        );
    }
}
