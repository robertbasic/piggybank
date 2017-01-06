<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

class Money
{
    private $cents;

    private function __construct(int $cents)
    {
        $this->cents = $cents;
    }

    public static function fromFloat(float $amount) : self
    {
        $cents = (int) ($amount * 100);

        return new self($cents);
    }

    public function amount() : float
    {
        return $this->cents / 100;
    }

    private function cents() : int
    {
        return $this->cents;
    }

    public function add(Money $money) : self
    {
        return new self($this->cents() + $money->cents());
    }
}
