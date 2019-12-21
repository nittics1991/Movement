<?php

declare(strict_types=1);

namespace Concerto\test\container;

use Concerto\container\provider\AbstractServiceProvider;

class TestServiceProvider2 extends AbstractServiceProvider
{
    protected $provides = [
      'database.dns',
      \ArrayObject::class
    ];

    public function register()
    {
        $this->share('array.data', range(1, 10));
        
        $this->share(\ArrayObject::class, function ($container) {
            return new \ArrayObject(
                $container->get('array.data')
            );
        });
    }
}
