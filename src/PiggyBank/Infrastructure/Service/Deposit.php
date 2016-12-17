<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Service;

use InvalidArgumentException;
use PiggyBank\Domain\Exception\InvalidDepositAmount;
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

        $piggyBank = new PiggyBank($currentAmount);

        try {
            $piggyBank->deposit($amount);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }

        return $this->repository->save($piggyBank->getTotalDeposit());
    }
}
