<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Driver\Connection;
use Interop\Container\ContainerInterface;

class DatabaseConnectionFactory
{
    public function __invoke(ContainerInterface $container) : Connection
    {
        $config = $container->get('config');

        $connectionParams = $config['db'];

        $connection = DriverManager::getConnection($connectionParams);

        return $connection;
    }
}
