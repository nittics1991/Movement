<?php

declare(strict_types=1);

namespace Movement\test\container;

class TestClassHasDependencies
{
    public function __construct(\stdClass $argument)
    {
        $this->argument = $argument;
    }
}
