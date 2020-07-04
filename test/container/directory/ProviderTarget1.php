<?php

declare(strict_types=1);

namespace Movement\test\container\directory;

class ProviderTarget1
{
    public function __invoke()
    {
        return __CLASS__;
    }
}
