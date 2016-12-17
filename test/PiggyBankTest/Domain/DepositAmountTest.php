<?php

declare(strict_types=1);

namespace PiggyBankTest\Domain;

use PiggyBank\Domain\DepositAmount;
use PiggyBank\Domain\Money;

class DepositAmountTest extends \PHPUnit_Framework_TestCase
{
    public function test_total_amount_is_same_as_initial_deposited_amount()
    {
        $amount = '100';

        $depositAmount = DepositAmount::fromString($amount);

        $result = $depositAmount->getAmount();

        $expected = 100.0;

        self::assertInstanceOf(Money::class, $result);
        self::assertSame($expected, $result->amount());
    }

    public function test_throws_an_invalid_deposit_amount_exception_if_amount_to_deposit_is_zero()
    {
        self::setExpectedException('PiggyBank\Domain\Exception\InvalidDepositAmount');

        $amount = '0';

        DepositAmount::fromString($amount);
    }
}
