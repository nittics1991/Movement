<?php

declare(strict_types=1);

namespace Concerto\test\container;

use Concerto\container\provider\AbstractServiceProvider;

class TestServiceProvider32 extends AbstractServiceProvider
{
    protected $provides = [
      'array.data',
    ];

    public function register()
    {
        $this->share('array.data', range(1, 10));
    }
}
