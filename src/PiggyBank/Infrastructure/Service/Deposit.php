<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Service;

use PiggyBank\Domain\PiggyBank;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;

class Deposit
{
    protected $repository;

    public function __construct(PiggyBankRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deposit(string $amount) : bool
    {
        $currentAmount = $this->repository->getCurrentAmount();

        $piggyBank = new PiggyBank();

        $piggyBank->deposit($amount);

        return $this->repository->save($piggyBank->getTotalDeposit());
    }
}
