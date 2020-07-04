<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\container\provider\AbstractServiceProvider;
use Movement\test\container\TestClassMixReflectionAndProviderOther;
use Movement\container\provider\BootableServiceProviderInterface;

class TestServiceProvider42 extends AbstractServiceProvider implements
    BootableServiceProviderInterface
{
    protected $provides = [
        TestClassMixReflectionAndProvider::class,
    ];

    public function register()
    {
    }
    
    public function boot()
    {
        $this->extend(TestClassMixReflectionAndProvider::class, function () {
            return new TestClassMixReflectionAndProviderOther();
        });
    }
}
