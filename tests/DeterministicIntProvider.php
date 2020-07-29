<?php

namespace Tests\Pierstoval\Live\Phpunit;

use Pierstoval\Live\Phpunit\RandomIntProviderInterface;

class DeterministicIntProvider implements RandomIntProviderInterface
{
    public int $value;

    public function randomInt(int $maxValue): int
    {
        return $this->value;
    }
}
