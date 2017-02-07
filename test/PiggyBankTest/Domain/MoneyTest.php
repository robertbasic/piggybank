<?php

declare(strict_types=1);

namespace PiggyBankTest\Domain;

use PHPUnit\Framework\TestCase;
use PiggyBank\Domain\Money;

class MoneyTest extends TestCase
{
    public function test_amount_returned_is_same_as_amount_put_in()
    {
        $amount = 100.0;

        $money = Money::fromFloat($amount);

        $result = $money->amount();

        $expected = 100.0;

        self::assertSame($expected, $result);
    }

    public function test_ammount_is_correctly_added()
    {
        $amount = 100.0;

        $money = Money::fromFloat($amount);

        $otherFloat = 55.6;

        $otherMoney = Money::fromFloat($otherFloat);

        $newMoney = $money->add($otherMoney);

        $result = $newMoney->amount();

        $expected = 155.6;

        self::assertSame($expected, $result);
    }
}
