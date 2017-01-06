<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

use PiggyBank\Domain\Exception\InvalidDepositAmount;

class PiggyBank
{
    /**
     * @var PiggyBank\Domain\Money
     */
    private $totalAmount;

    public function __construct(float $currentAmount)
    {
        $this->totalAmount = Money::fromFloat($currentAmount);
    }

    public function deposit(string $amount)
    {
        $deposit = Money::fromFloat((float) $amount);

        if ($deposit->amount() == 0) {
            throw new InvalidDepositAmount("Can't deposit zero amount!");
        }

        $this->totalAmount = $this->totalAmount->add($deposit);
    }

    public function getTotalDeposit() : float
    {
        return $this->totalAmount->amount();
    }
}
