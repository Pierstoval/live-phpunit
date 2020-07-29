<?php

namespace Pierstoval\Live\Phpunit;

interface RandomIntProviderInterface
{
    public function randomInt(int $maxValue): int;
}
