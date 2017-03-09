<?php

declare(strict_types=1);

namespace PiggyBank\Application\Service;

use Psr\Container\ContainerInterface;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;
use PiggyBank\Domain\PiggyBank;

class DepositFactory
{
    public function __invoke(ContainerInterface $container) : Deposit
    {
        $repository = $container->get(PiggyBankRepository::class);

        $currentAmount = $repository->getCurrentAmount();
        $piggyBank = PiggyBank::withCurrentAmount($currentAmount);

        return new Deposit($piggyBank, $repository);
    }
}
