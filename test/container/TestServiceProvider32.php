<?php

declare(strict_types=1);

namespace Movement\test\container;

use Movement\container\provider\AbstractServiceProvider;

class TestServiceProvider32 extends AbstractServiceProvider
{
    protected $provides = [
      'array.data',
    ];

    public function register()
    {
        $this->raw(
            'array.data',
            ['sqlite::memory:', 'select * from table']
        );
    }
}
