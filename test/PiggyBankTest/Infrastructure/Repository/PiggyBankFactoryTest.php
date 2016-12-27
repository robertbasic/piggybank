<?php

declare(strict_types=1);

namespace PiggyBankTest\Infrastructure\Repository;

define('DB_CONNECTION', 'DB_CONNECTION');

use Doctrine\DBAL\Driver\Connection;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PiggyBank\Infrastructure\Repository\PiggyBank;
use PiggyBank\Infrastructure\Repository\PiggyBankFactory;

class PiggyBankFactoryTest extends MockeryTestCase
{
    public function test_piggybank_factory_creates_piggybank_repository()
    {
        $connection = m::mock('Doctrine\DBAL\Driver\Connection');
        $connection->shouldReceive('createQueryBuilder');

        $container = m::mock('Zend\ServiceManager\ServiceManager');
        $container->shouldReceive('get')
            ->once()
            ->with(DB_CONNECTION)
            ->andReturn($connection);

        $factory = new PiggyBankFactory();

        $repository = $factory($container);

        self::assertInstanceOf(PiggyBank::class, $repository);
    }
}
