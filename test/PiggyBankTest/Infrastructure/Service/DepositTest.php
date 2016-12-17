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
}
