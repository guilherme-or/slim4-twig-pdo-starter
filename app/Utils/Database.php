<?php

declare(strict_types=1);

namespace App\Utils;

use PDO;
use PDOStatement;

class Database
{
    private PDO $connection;

    /**
     * Constructor to initialize the database connection.
     *
     * @param PDO $connection The PDO database connection.
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Sets the parameter bindings for a prepared statement.
     *
     * @param PDOStatement $statement The prepared statement.
     * @param array $binds An associative array of parameter bindings.
     *
     * @return PDOStatement The prepared statement with bindings set.
     */
    private function setBinds(PDOStatement $statement, array $binds = []): PDOStatement
    {
        foreach ($binds as $key => $value) {
            $statement->bindValue($key, $value);
        }

        return $statement;
    }

    /**
     * Prepares and executes a database query with parameter bindings.
     *
     * @param string $query The SQL query to execute.
     * @param array $binds An associative array of parameter bindings.
     * @param bool $fetchAll Whether to fetch all rows or just one.
     *
     * @return array An associative array of query results.
     */
    public function dataPrepare(string $query, array $binds = [], bool $fetchAll = true): array
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

    /**
     * Executes a direct database query without parameter bindings.
     *
     * @param string $query The SQL query to execute.
     * @param bool $fetchAll Whether to fetch all rows or just one.
     *
     * @return array An associative array of query results.
     */
    public function dataQuery(string $query, bool $fetchAll = true): array
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

    /**
     * Prepares and executes a database query with parameter bindings.
     *
     * @param string $query The SQL query to execute.
     * @param array $binds An associative array of parameter bindings.
     *
     * @return bool True if the query was executed successfully, otherwise false.
     */
    public function directPrepare(string $query, array $binds = []): bool
    {
        $statement = $this->connection->prepare($query);
        $this->setBinds($statement, $binds);

        $result = $statement->execute();

        return $result;
    }

    /**
     * Executes a direct database query without parameter bindings.
     *
     * @param string $query The SQL query to execute.
     *
     * @return bool True if the query was executed successfully, otherwise false.
     */
    public function directQuery(string $query): bool
    {
        $statement = $this->connection->query($query);

        if (!$statement) {
            return false;
        }

        return true;
    }
}
