<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

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
