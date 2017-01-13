<?php

declare(strict_types=1);

namespace PiggyBank\Application\Service;

use Doctrine\DBAL\Exception\ServerException;
use PiggyBank\Domain\Exception\InvalidDepositAmount;
use PiggyBank\Domain\PiggyBank;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;

class Deposit
{
    protected $piggyBank;

    protected $repository;

    public function __construct(PiggyBank $piggyBank, PiggyBankRepository $repository)
    {
        $this->piggyBank = $piggyBank;
        $this->repository = $repository;
    }

    public function deposit(string $amount) : bool
    {
        try {
            $this->piggyBank->deposit($amount);
        } catch (InvalidDepositAmount $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }

        try {
            $totalDeposit = $this->piggyBank->getTotalDeposit();
            return $this->repository->save($totalDeposit);
        } catch (ServerException $e) {
            throw new Exception\RepositoryException("Saving to repository failed!", $e->getCode(), $e);
        }
    }
}
