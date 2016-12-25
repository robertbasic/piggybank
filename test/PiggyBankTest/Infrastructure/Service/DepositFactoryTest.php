<?php

declare(strict_types=1);

namespace PiggyBankTest\Infrastructure\Service;

use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;
use PiggyBank\Infrastructure\Service\Deposit;
use PiggyBank\Infrastructure\Service\DepositFactory;

class DepositFactoryTest extends MockeryTestCase
{
    public function test_deposit_factory_creates_deposit_service()
    {
        $repository = m::mock('PiggyBank\Infrastructure\Repository\PiggyBank');
        $container = m::mock('Zend\ServiceManager\ServiceManager');
        $container->shouldReceive('get')
            ->once()
            ->with(PiggyBankRepository::class)
            ->andReturn($repository);

        $factory = new DepositFactory($container);

        $service = $factory($container);

        self::assertInstanceOf(Deposit::class, $service);
    }
}
