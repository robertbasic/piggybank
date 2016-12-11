<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

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
        $money = new Money((float) $amount);

        return new self($money);
    }

    public function getAmount() : Money
    {
        return $this->money;
    }
}
