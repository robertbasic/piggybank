<?php

declare(strict_types=1);

namespace PiggyBankTest\Application\Service;

use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Exception\ServerException;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use PiggyBank\Application\Service\Deposit;
use PiggyBank\Domain\PiggyBank;

class DepositTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected $service;

    protected $repositoryMock;

    public function setup()
    {
        $this->repositoryMock = m::mock('PiggyBank\Infrastructure\Repository\PiggyBank');

        $piggyBank = PiggyBank::withCurrentAmount(10.46);

        $this->service = new Deposit($piggyBank, $this->repositoryMock);
    }

    public function test_deposits_amount()
    {
        $amount = '2.43';

        $this->repositoryMock->shouldReceive('save')
            ->once()
            ->with(12.89)
            ->andReturn(true);

        $result = $this->service->deposit($amount);

        self::assertTrue($result);
    }

    public function test_throws_exception_for_zero_amount_to_deposit()
    {
        self::expectException('\InvalidArgumentException');

        $amount = '0';

        $this->repositoryMock->shouldReceive('save')
            ->never();

        $this->service->deposit($amount);
    }

    public function test_throws_exception_when_saving_to_repository_fails()
    {
        self::expectException('PiggyBank\Application\Service\Exception\RepositoryException');

        $amount = '2.43';

        $exception = new ServerException('message', new PDOException(new \PDOException()));

        $this->repositoryMock->shouldReceive('save')
            ->once()
            ->with(12.89)
            ->andThrow($exception);

        $this->service->deposit($amount);
    }
}
