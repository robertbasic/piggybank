<?php

declare(strict_types=1);

namespace PiggyBankTest\Infrastructure\Repository;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Driver\Statement;
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
        $this->statementMock = m::mock('Doctrine\DBAL\Driver\Statement');

        $this->queryBuilderMock = m::mock('Doctrine\DBAL\Query\QueryBuilder');

        $this->connectionMock = m::mock('Doctrine\DBAL\Driver\Connection');
        $this->connectionMock->shouldReceive('createQueryBuilder')
            ->once()
            ->withNoArgs()
            ->andReturn($this->queryBuilderMock);

        $this->repository = new PiggyBank($this->connectionMock);
    }

    public function test_getting_current_amount()
    {
        $this->queryBuilderMock->shouldReceive('select')
            ->once()
            ->with('current_amount')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('from')
            ->once()
            ->with('piggybank')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('orderBy')
            ->once()
            ->with('id', 'DESC')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('setMaxResults')
            ->once()
            ->with(1)
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('execute')
            ->once()
            ->withNoArgs()
            ->andReturn($this->statementMock);

        $this->statementMock->shouldReceive('fetch')
            ->once()
            ->withNoArgs()
            ->andReturn(['current_amount' => '2.3']);

        $result = $this->repository->getCurrentAmount();

        $expected = 2.3;

        self::assertSame($expected, $result);
    }

    public function test_getting_current_amount_returns_zero_when_no_current_amount()
    {
        $this->queryBuilderMock->shouldReceive('select')
            ->once()
            ->with('current_amount')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('from')
            ->once()
            ->with('piggybank')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('orderBy')
            ->once()
            ->with('id', 'DESC')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('setMaxResults')
            ->once()
            ->with(1)
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('execute')
            ->once()
            ->withNoArgs()
            ->andReturn($this->statementMock);

        $this->statementMock->shouldReceive('fetch')
            ->once()
            ->withNoArgs()
            ->andReturn(false);

        $result = $this->repository->getCurrentAmount();

        $expected = 0.0;

        self::assertSame($expected, $result);
    }

    public function test_saves_current_deposit_to_the_database()
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

    public function test_save_returns_false_when_nothing_was_inserted()
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
