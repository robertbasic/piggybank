<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

use PiggyBank\Domain\Exception\InvalidDepositAmount;

class DepositAmount
{
    /**
     * @var PiggyBank\Domain\Money
     */
    private $money;

    private function __construct(Money $money)
    {
        $this->money = $money;
    }

    public static function fromString(string $amount) : self
    {
        $money = Money::fromAmount((float) $amount);

        if ($money->amount() == 0) {
            throw new InvalidDepositAmount("Deposit amount can't be zero!");
        }

        return new self($money);
    }

    public function getAmount() : Money
    {
        return $this->money;
    }
}
