<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Repository;

use Doctrine\DBAL\Driver\Connection;

class PiggyBank
{
    private $connection;

    const TABLE_PIGGYBANK = 'piggybank';

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function save(float $currentDeposit) : bool
    {
        $insert = $this->sql->insert();

        $insert = $insert->into(self::TABLE_PIGGYBANK);

        $insert = $insert->columns([
            'current_amount'
        ]);

        $insert = $insert->values([
            $currentDeposit
        ]);

        $statement = $this->sql->prepareStatementForSqlObject($insert);

        try {
            $result = $statement->execute();
            return $result->count() === 1;
        } catch (\Exception $e) {
            return false;
        }
    }
}
