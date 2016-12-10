<?php

declare(strict_types=1);

namespace PiggyBankTest\Application;

use PiggyBank\Application\PiggyBank;

class PiggyBankTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_deposits_the_amount_provided()
    {
        $amount = '100';

        $piggyBank = new PiggyBank();

        $piggyBank->deposit($amount);

        $result = $piggyBank->getTotalDeposit();

        $expected = 100.0;

        self::assertSame($expected, $result);
    }
}
