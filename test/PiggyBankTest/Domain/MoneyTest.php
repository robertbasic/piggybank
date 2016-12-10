<?php

declare(strict_types=1);

namespace PiggyBankTest\Domain;

use PiggyBank\Domain\Money;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    public function test_amount_returned_is_same_as_amount_put_in()
    {
        $amount = 100.0;

        $money = new Money($amount);

        $result = $money->amount();

        $expected = 100.0;

        self::assertSame($expected, $result);
    }

    public function test_ammount_is_correctly_added()
    {
        $amount = 100.0;

        $money = new Money($amount);

        $otherAmount = 55.6;

        $otherMoney = new Money($otherAmount);

        $newMoney = $money->add($otherMoney);

        $result = $newMoney->amount();

        $expected = 155.6;

        self::assertSame($expected, $result);
    }
}