<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

class Money
{
    private $cent;

    public function __construct(float $amount)
    {
        $this->cent = $amount * 100;
    }

    public function amount() : float
    {
        return $this->cent / 100;
    }

    private function cents() : int
    {
        return $this->cent;
    }

    public function add(Money $money) : self
    {
        // @todo refactor so it can work with $this->cents()
        // need to use named constructors for that
        return new self($this->amount() + $money->amount());
    }
}
