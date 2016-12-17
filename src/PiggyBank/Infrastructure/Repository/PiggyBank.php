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

    public function getCurrentAmount() : float
    {
        $statement = $this->queryBuilder
            ->select('current_amount')
            ->from(self::TABLE_PIGGYBANK)
            ->orderBy('id', 'DESC')
            ->setMaxResults(1)
            ->execute();

        $result = $statement->fetch();

        if (!$result) {
            return 0;
        }

        return (float) $result['current_amount'];
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
