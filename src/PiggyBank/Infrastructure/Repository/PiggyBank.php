<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Repository;

use Doctrine\DBAL\Driver\Connection;

class PiggyBank
{
    private $connection;

    private $queryBuilder;

    const TABLE_PIGGYBANK = 'piggybank';

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;

        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public function save(float $currentDeposit) : bool
    {
        $result = $this->queryBuilder
            ->insert(self::TABLE_PIGGYBANK)
            ->values(
                [
                    'current_amount' => '?'
                ]
            )
            ->setParameter(0, $currentDeposit)
            ->execute();

        return $result === 1;
    }
}
