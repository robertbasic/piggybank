<?php

declare(strict_types=1);

namespace PiggyBankTest\Infrastructure\Repository;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PiggyBank\Infrastructure\Repository\PiggyBank;

class PiggyBankTest extends MockeryTestCase
{
    protected $repository;

    protected $queryBuilderMock;

    protected $connectionMock;

    public function setup()
    {
        $this->queryBuilderMock = m::mock('Doctrine\DBAL\Query\QueryBuilder');

        $this->connectionMock = m::mock('Doctrine\DBAL\Driver\Connection');
        $this->connectionMock->shouldReceive('createQueryBuilder')
            ->once()
            ->withNoArgs()
            ->andReturn($this->queryBuilderMock);

        $this->repository = new PiggyBank($this->connectionMock);
    }

    public function testSavesCurrentDepositToTheDatabase()
    {
        $currentDeposit = 4.3;

        $this->queryBuilderMock->shouldReceive('insert')
            ->once()
            ->with('piggybank')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('values')
            ->once()
            ->with(['current_amount' => '?'])
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('setParameter')
            ->once()
            ->with(0, $currentDeposit)
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('execute')
            ->once()
            ->withNoArgs()
            ->andReturn(1);

        $result = $this->repository->save($currentDeposit);

        self::assertTrue($result);
    }

    public function testSaveReturnsFalseForAnException()
    {
        $currentDeposit = 4.3;

        $this->queryBuilderMock->shouldReceive('insert')
            ->once()
            ->with('piggybank')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('values')
            ->once()
            ->with(['current_amount' => '?'])
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('setParameter')
            ->once()
            ->with(0, $currentDeposit)
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('execute')
            ->once()
            ->withNoArgs()
            ->andReturn(0);

        $result = $this->repository->save($currentDeposit);

        self::assertFalse($result);
    }
}
