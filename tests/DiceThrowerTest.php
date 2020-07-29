<?php

namespace Tests\Pierstoval\Live\Phpunit;

use InvalidArgumentException;
use Pierstoval\Live\Phpunit\DiceThrower;
use PHPUnit\Framework\TestCase;

use function sprintf;

class DiceThrowerTest extends TestCase
{
    /**
     * @dataProvider provide_valid_throws_bonus_values
     */
    public function test_it_can_roll_a_2d6_dice_with_custom_bonus_value(int $bonusValue): void
    {
        $sides = 6;

        $diceThrower = $this->getDiceThrower($sides);

        $result = $diceThrower->roll(2, $sides, $bonusValue);

        static::assertSame(2 * $sides + $bonusValue, $result);
    }

    public function provide_valid_throws_bonus_values(): iterable
    {
        yield 'Bonus 0' => [0];
        yield 'Bonus 1' => [1];
        yield 'Bonus 200' => [200];
        yield 'Bonus -31' => [-31];
    }

    /**
     * @dataProvider provide_invalid_numbers_of_dices
     */
    public function test_throwing_an_invalid_number_of_dices_throws_an_exception(int $numberOfDices): void
    {
        $diceThrower = $this->getDiceThrower();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf(
            'Number of dices must be greater than 0, "%d" given.',
            $numberOfDices
        ));

        $diceThrower->roll($numberOfDices, 6, 3);
    }

    public function provide_invalid_numbers_of_dices(): iterable
    {
        yield 'With zero dices' => [0];
        yield 'With -1 dices' => [-1];
        yield 'With -100 dices' => [-100];
    }

    /**
     * @dataProvider provide_invalid_numbers_of_sides
     */
    public function test_throwing_an_invalid_number_of_sides_throws_an_exception(int $numberOfSides): void
    {
        $diceThrower = $this->getDiceThrower();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Number of sides per dice must be greater than 1, "%d" given.',
            $numberOfSides
        ));

        $diceThrower->roll(1, $numberOfSides, 3);
    }

    public function provide_invalid_numbers_of_sides(): iterable
    {
        yield 'With one sides' => [1];
        yield 'With zero sides' => [0];
        yield 'With -1 sides' => [-1];
        yield 'With -100 sides' => [-100];
    }

    public function getDiceThrower(int $determinedValue = 2): DiceThrower
    {
        $provider = new DeterministicIntProvider();

        $provider->value = $determinedValue;

        return new DiceThrower($provider);
    }
}
