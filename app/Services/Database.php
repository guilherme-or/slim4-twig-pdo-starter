<?php

namespace App\Services;

use Exception;
use PDO;

class Database
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function setBinds($statement, $binds = array())
    {
        foreach ($binds as $key => $value) {
            $statement->bindValue($key, $value);
        }

        return $statement;
    }

    public function dataPrepare($query, $binds = [], $fetchAll = true)
    {
        $statement = $this->connection->prepare($query);
        $this->setBinds($statement, $binds);

        if (!$statement->execute()) {
            return [];
        }

        $result = $fetchAll ? $statement->fetchAll(PDO::FETCH_ASSOC) : $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function dataQuery($query, $fetchAll = true)
    {
        $statement = $this->connection->query($query);

        if (!$statement) {
            return [];
        }

        $result = $fetchAll ? $statement->fetchAll(PDO::FETCH_ASSOC) : $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function directPrepare($query, $binds = [])
    {
        $statement = $this->connection->prepare($query);
        $this->setBinds($statement, $binds);

        $result = $statement->execute();

        return $result;
    }

    public function directQuery($query)
    {
        $statement = $this->connection->query($query);

        if (!$statement) {
            return false;
        }

        return true;
    }
}
