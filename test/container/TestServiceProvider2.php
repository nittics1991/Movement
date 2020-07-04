<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\container\provider\AbstractServiceProvider;

class TestServiceProvider2 extends AbstractServiceProvider
{
    protected $provides = [
      'array.data',
      \ArrayObject::class
    ];

    public function register()
    {
        $this->raw(
            'array.data',
            ['sqlite::memory:', 'select * from table']
        );
        
        $this->share(\ArrayObject::class, function ($container) {
            return new \ArrayObject(
                $container->get('array.data')
            );
        });
    }
}
