<?php

declare(strict_types=1);

namespace PiggyBankTest\Infrastructure\Service;

use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Exception\ServerException;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PiggyBank\Infrastructure\Repository\PiggyBank;
use PiggyBank\Infrastructure\Service\Deposit;

class DepositTest extends MockeryTestCase
{
    protected $service;

    protected $repositoryMock;

    public function setup()
    {
        $this->repositoryMock = m::mock('PiggyBank\Infrastructure\Repository\PiggyBank');

        $this->service = new Deposit($this->repositoryMock);
    }

    public function test_deposits_amount()
    {
        $amount = '2.43';

        $this->repositoryMock->shouldReceive('getCurrentAmount')
            ->once()
            ->withNoArgs()
            ->andReturn(10.46);

        $this->repositoryMock->shouldReceive('save')
            ->once()
            ->with(12.89)
            ->andReturn(true);

        $result = $this->service->deposit($amount);

        self::assertTrue($result);
    }

    public function test_throws_exception_for_zero_amount_to_deposit()
    {
        self::setExpectedException('\InvalidArgumentException');

        $amount = '0';

        $this->repositoryMock->shouldReceive('getCurrentAmount')
            ->once()
            ->withNoArgs()
            ->andReturn(10.46);

        $this->repositoryMock->shouldReceive('save')
            ->never();

        $this->service->deposit($amount);
    }

    public function test_throws_exception_when_saving_to_repository_fails()
    {
        self::setExpectedException('PiggyBank\Infrastructure\Service\Exception\RepositoryException');

        $amount = '2.43';

        $this->repositoryMock->shouldReceive('getCurrentAmount')
            ->once()
            ->withNoArgs()
            ->andReturn(10.46);

        $exception = new ServerException('message', new PDOException(new \PDOException()));

        $this->repositoryMock->shouldReceive('save')
            ->once()
            ->with(12.89)
            ->andThrow($exception);

        $this->service->deposit($amount);
    }
}
