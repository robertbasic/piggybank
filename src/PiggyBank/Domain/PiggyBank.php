<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

class PiggyBank
{
    /**
     * @var PiggyBank\Domain\Money
     */
    private $totalAmount;

    public function __construct()
    {
        $this->totalAmount = new Money(0);
    }

    public function deposit(string $amount)
    {
        $deposit = DepositAmount::fromString($amount);

        $this->totalAmount = $this->totalAmount->add($deposit->getAmount());
    }

    public function getTotalDeposit() : float
    {
        return $this->totalAmount->amount();
    }
}
