<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Repository;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class PiggyBank
{
    private $adapter;
    private $sql;

    const TABLE_PIGGYBANK = 'piggybank';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->sql = new Sql($this->adapter);
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
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
