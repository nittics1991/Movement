<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\container\provider\AbstractServiceProvider;

class TestServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
      \stdClass::class
    ];

    public function register()
    {
        $this->bind(\stdClass::class, function () {
            return new \stdClass();
        });
    }
}
