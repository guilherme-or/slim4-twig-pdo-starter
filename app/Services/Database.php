<?php

namespace App\Services;

use PDO;
use PDOStatement;

class Database
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    private function setBinds($statement, $binds = array()): PDOStatement
    {
        foreach ($binds as $key => $value) {
            $statement->bindValue($key, $value);
        }

        return $statement;
    }

    public function dataPrepare($query, $binds = [], $fetchAll = true): array
    {
        $statement = $this->connection->prepare($query);
        $this->setBinds($statement, $binds);

        if (!$statement->execute()) {
            return [];
        }

        $result = $fetchAll ? $statement->fetchAll(PDO::FETCH_ASSOC) : $statement->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return [];
        }

        return $result;
    }

    public function dataQuery($query, $fetchAll = true): array
    {
        $statement = $this->connection->query($query);

        if (!$statement) {
            return [];
        }

        $result = $fetchAll ? $statement->fetchAll(PDO::FETCH_ASSOC) : $statement->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return [];
        }

        return $result;
    }

    public function directPrepare($query, $binds = []): bool
    {
        $statement = $this->connection->prepare($query);
        $this->setBinds($statement, $binds);

        $result = $statement->execute();

        return $result;
    }

    public function directQuery($query): bool
    {
        $statement = $this->connection->query($query);

        if (!$statement) {
            return false;
        }

        return true;
    }
}
