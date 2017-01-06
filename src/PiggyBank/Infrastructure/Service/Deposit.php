<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Service;

use Doctrine\DBAL\Exception\ServerException;
use PiggyBank\Domain\Exception\InvalidDepositAmount;
use PiggyBank\Domain\PiggyBank;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;
use PiggyBank\Infrastructure\Service\Exception\RepositoryException;

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
        } catch (InvalidDepositAmount $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }

        try {
            return $this->repository->save($piggyBank->getTotalDeposit());
        } catch (ServerException $e) {
            throw new RepositoryException("Saving to repository failed!", $e->getCode(), $e);
        }
    }
}
