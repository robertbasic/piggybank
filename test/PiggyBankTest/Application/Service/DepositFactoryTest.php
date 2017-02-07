<?php

declare(strict_types=1);

namespace PiggyBankTest\Application\Service;

use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use PiggyBank\Application\Service\Deposit;
use PiggyBank\Application\Service\DepositFactory;
use PiggyBank\Infrastructure\Repository\PiggyBank as PiggyBankRepository;

class DepositFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function test_deposit_factory_creates_deposit_service()
    {
        $repository = m::mock('PiggyBank\Infrastructure\Repository\PiggyBank');
        $repository->shouldReceive('getCurrentAmount')
            ->once()
            ->andReturn(10.46);

        $container = m::mock('Zend\ServiceManager\ServiceManager');
        $container->shouldReceive('get')
            ->once()
            ->with(PiggyBankRepository::class)
            ->andReturn($repository);

        $factory = new DepositFactory();

        $service = $factory($container);

        self::assertInstanceOf(Deposit::class, $service);
    }
}
