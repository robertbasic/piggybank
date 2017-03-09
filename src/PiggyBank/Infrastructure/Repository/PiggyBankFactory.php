<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Repository;

use Psr\Container\ContainerInterface;

class PiggyBankFactory
{
    public function __invoke(ContainerInterface $container) : PiggyBank
    {
        $connection = $container->get(DB_CONNECTION);

        return new PiggyBank($connection);
    }
}
