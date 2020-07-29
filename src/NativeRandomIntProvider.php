<?php

namespace Pierstoval\Live\Phpunit;

use function random_int;

class NativeRandomIntProvider implements RandomIntProviderInterface
{
    public function randomInt(int $maxValue): int
    {
        return random_int(1, $maxValue);
    }
}
