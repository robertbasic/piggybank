<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

use InvalidArgumentException;
use PiggyBank\Domain\Exception\InvalidDepositAmount;

class PiggyBank
{
    /**
     * @var PiggyBank\Domain\Money
     */
    private $totalAmount;

    public function __construct(float $currentAmount)
    {
        $this->totalAmount = new Money($currentAmount);
    }

    public function deposit(string $amount)
    {
        try {
            $deposit = DepositAmount::fromString($amount);
        } catch (InvalidDepositAmount $e) {
            throw new InvalidArgumentException($e->getMessage());
        }

        $this->totalAmount = $this->totalAmount->add($deposit->getAmount());
    }

    public function getTotalDeposit() : float
    {
        return $this->totalAmount->amount();
    }
}
