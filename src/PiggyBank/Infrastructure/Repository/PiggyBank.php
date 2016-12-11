<?php

declare(strict_types=1);

namespace PiggyBank\Infrastructure\Repository;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class PiggyBank
{
    private $adapter;
    private $sql;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->sql = new Sql($this->adapter);
    }

    public function save()
    {
    }
}
