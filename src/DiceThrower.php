<?php

declare(strict_types=1);

namespace Pierstoval\Live\Phpunit;

class DiceThrower
{
    private RandomIntProviderInterface $randomIntProvider;

    public function __construct(RandomIntProviderInterface $randomIntProvider)
    {
        $this->randomIntProvider = $randomIntProvider;
    }

    public function roll(
        int $numberOfDice,
        int $sides,
        int $bonus
    ): int {
        if ($numberOfDice <= 0) {
            throw new \InvalidArgumentException(\sprintf(
                'Number of dices must be greater than 0, "%d" given.',
                $numberOfDice
            ));
        }
        if ($sides <= 1) {
            throw new \InvalidArgumentException(\sprintf(
                'Number of sides per dice must be greater than 1, "%d" given.',
                $sides
            ));
        }

        $finalScore = $bonus;

        for ($i = 0; $i < $numberOfDice; $i++) {
            $diceRoll = $this->randomIntProvider->randomInt($sides);

            $finalScore += $diceRoll;
        }

        return $finalScore;
    }
}
