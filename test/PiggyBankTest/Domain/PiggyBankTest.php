<?php

declare(strict_types=1);

namespace PiggyBankTest\Domain;

use PiggyBank\Domain\PiggyBank;

class PiggyBankTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_deposits_the_amount_provided()
    {
        $amount = '100';

        $piggyBank = new PiggyBank(0);

        $resultStartAmount = $piggyBank->getTotalDeposit();

        $piggyBank->deposit($amount);

        $result = $piggyBank->getTotalDeposit();

        $expectedStartAmount = 0.0;
        $expected = 100.0;

        self::assertSame($expectedStartAmount, $resultStartAmount);
        self::assertSame($expected, $result);
    }

    public function test_total_deposit_amount_is_correct_after_two_deposits()
    {
        $firstAmount = '100';
        $secondAmount = '55.6';

        $piggyBank = new PiggyBank(0);

        $piggyBank->deposit($firstAmount);
        $piggyBank->deposit($secondAmount);

        $result = $piggyBank->getTotalDeposit();

        $expected = 155.6;

        self::assertSame($expected, $result);
    }

    public function test_deposit_amount_is_added_to_current_amount()
    {
        $amount = '100';

        $piggyBank = new PiggyBank(20);

        $resultStartAmount = $piggyBank->getTotalDeposit();

        $piggyBank->deposit($amount);

        $result = $piggyBank->getTotalDeposit();

        $expectedStartAmount = 20.0;
        $expected = 120.0;

        self::assertSame($expectedStartAmount, $resultStartAmount);
        self::assertSame($expected, $result);
    }

    public function test_throws_exception_for_zero_amount_to_deposit()
    {
        self::setExpectedException('\InvalidArgumentException');

        $amount = '0';

        $piggyBank = new PiggyBank(0);

        $piggyBank->deposit($amount);
    }
}
