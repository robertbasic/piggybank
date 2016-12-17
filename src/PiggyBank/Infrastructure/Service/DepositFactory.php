<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;

class DepositFactory
{
    public function __invoke(ContainerInterface $container) : Deposit
    {
        $repository = $container->get(PiggyBankRepository::class);

        return new Deposit($repository);
    }
}
