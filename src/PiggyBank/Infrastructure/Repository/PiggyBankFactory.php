<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Repository;

use Interop\Container\ContainerInterface;
use Zend\Db\Sql\Sql;

class PiggyBankFactory
{
    public function __invoke(ContainerInterface $container) : PiggyBank
    {
        $adapter = $container->get('DatabaseAdapter');

        $sql = new Sql($adapter);

        return new PiggyBank($sql, $adapter);
    }
}
