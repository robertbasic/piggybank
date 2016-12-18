<?php

declare(strict_types=1);

namespace PiggyBank\Domain;

class Money
{
    private $cent;

    private function __construct(int $cent)
    {
        $this->cent = $cent;
    }

    public static function fromAmount(float $amount) : self
    {
        $cent = (int) ($amount * 100);

        return new self($cent);
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
        return new self($this->cents() + $money->cents());
    }
}
