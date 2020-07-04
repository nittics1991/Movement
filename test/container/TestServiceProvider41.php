<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\container\provider\AbstractServiceProvider;
use Movement\test\container\TestClassMixReflectionAndProviderOther;

class TestServiceProvider41 extends AbstractServiceProvider
{
    protected $provides = [
        TestClassMixReflectionAndProvider::class,
    ];

    public function register()
    {
        $this->bind(TestClassMixReflectionAndProvider::class, function () {
            return new TestClassMixReflectionAndProviderOther();
        });
    }
}
