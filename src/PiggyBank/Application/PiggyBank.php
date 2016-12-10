<?php

declare(strict_types=1);

namespace PiggyBank\Application;

use PiggyBank\Domain\DepositAmount;

class PiggyBank
{
    private $deposit;

    public function deposit(string $amount)
    {
        $this->deposit = DepositAmount::fromString($amount);
    }

    public function getTotalDeposit() : float
    {
        return $this->deposit->getTotalAmount();
    }
}
