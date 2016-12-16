<?php

declare(strict_types=1);

namespace PiggyBankTest\Infrastructure\Repository;

use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PiggyBank\Infrastructure\Repository\PiggyBank;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo\Result;
use Zend\Db\Adapter\Driver\Pdo\Statement;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;

class PiggyBankTest extends MockeryTestCase
{
    protected $repository;

    protected $sqlMock;

    protected $adapterMock;

    protected $insertMock;

    protected $statementMock;

    protected $resultMock;

    public function setup()
    {
        $this->sqlMock = m::mock('Zend\Db\Sql\Sql');
        $this->adapterMock = m::mock('Zend\Db\Adapter\Adapter');
        $this->insertMock = m::mock('Zend\Db\Sql\Insert');
        $this->statementMock = m::mock('Zend\Db\Adapter\Driver\Pdo\Statement');
        $this->resultMock = m::mock('Zend\Db\Adapter\Driver\Pdo\Result');

        $this->repository = new PiggyBank($this->sqlMock, $this->adapterMock);
    }

    public function testSavesCurrentDepositToTheDatabase()
    {
        $currentDeposit = 4.3;

        $this->sqlMock->shouldReceive('insert')
            ->once()
            ->withNoArgs()
            ->andReturn($this->insertMock);

        $this->insertMock->shouldReceive('into')
            ->once()
            ->with('piggybank')
            ->andReturnSelf();

        $this->insertMock->shouldReceive('columns')
            ->once()
            ->with(['current_amount'])
            ->andReturnSelf();

        $this->insertMock->shouldReceive('values')
            ->once()
            ->with([$currentDeposit])
            ->andReturnSelf();

        $this->sqlMock->shouldReceive('prepareStatementForSqlObject')
            ->once()
            ->with($this->insertMock)
            ->andReturn($this->statementMock);

        $this->statementMock->shouldReceive('execute')
            ->once()
            ->withNoArgs()
            ->andReturn($this->resultMock);

        $this->resultMock->shouldReceive('count')
            ->once()
            ->withNoArgs()
            ->andReturn(1);

        $result = $this->repository->save($currentDeposit);

        $this->assertTrue($result);
    }
}
