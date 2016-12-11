<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Repository;

use Interop\Container\ContainerInterface;

class PiggyBankFactory
{
    public function __invoke(ContainerInterface $container) : PiggyBank
    {
        $adapter = $container->get('DatabaseAdapter');

        return new PiggyBank($adapter);
    }
}
