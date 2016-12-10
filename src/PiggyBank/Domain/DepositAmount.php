<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

class DepositAmount
{
    /**
     * @var PiggyBank\Domain\Money
     */
    private $money;

    /**
     * @var PiggyBank\Domain\Money
     */
    private $totalAmount;

    private function __construct(Money $money)
    {
        $this->money = $money;

        if (!$this->totalAmount) {
            // @todo is there a better way than to have a things like zero money?
            $this->totalAmount = new Money(0);
        }

        $this->totalAmount->add($money);
    }

    public static function fromString(string $amount) : DepositAmount
    {
        $money = new Money((float) $amount);

        return new self($money);
    }

    public function getTotalAmount() : float
    {
        return $this->totalAmount->amount();
    }
}
