<?php

declare(strict_types=1);

namespace PiggyBankTest\Infrastructure\Service;

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

    public function testDepositsAmount()
    {
        $amount = '2.43';

        $this->repositoryMock->shouldReceive('save')
            ->once()
            ->with(2.43)
            ->andReturn(true);

        $result = $this->service->deposit($amount);

        self::assertTrue($result);
    }
}
