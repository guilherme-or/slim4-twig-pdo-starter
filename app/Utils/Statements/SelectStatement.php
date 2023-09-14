<?php

declare(strict_types=1);

namespace App\Utils\Statements;

use App\Utils\Database;

class SelectStatement
{
    private Database $database;
    private string $selectQuery;
    private array $selectQueryBinds;
    private string $lastMethod;

    public function __construct(string $columns, string $tableName, Database $database)
    {
        $this->database = $database;
        $this->selectQuery = "SELECT $columns FROM $tableName";
        $this->selectQueryBinds = [];
        $this->lastMethod = 'select';
    }

    public function fetch(bool $fetchAll = true): array
    {
        return $this->database->dataPrepare($this->selectQuery, $this->selectQueryBinds, $fetchAll);
    }

    public function where(string $condition = "1 = 1", array $conditionBinds = []): SelectStatement
    {
        if ($this->lastMethod !== 'select') {
            return $this;
        }

        $this->selectQuery .= " WHERE $condition";
        $this->selectQueryBinds += $conditionBinds;
        $this->lastMethod = 'where';
        return $this;
    }

    public function join(string $joinTableName, string $joinCondition): SelectStatement
    {
        if ($this->lastMethod !== 'select') {
            return $this;
        }

        $this->selectQuery .= " JOIN $joinTableName ON $joinCondition";
        $this->lastMethod = 'join';
        return $this;
    }

    public function groupBy(array $columns): SelectStatement
    {
        if ($this->lastMethod !== 'select' && $this->lastMethod !== 'where') {
            return $this;
        }

        $groupByColumns = implode(", ", $columns);
        $this->selectQuery .= " GROUP BY $groupByColumns";
        $this->lastMethod = 'groupBy';
        return $this;
    }

    public function having(string $condition, array $conditionBinds = []): SelectStatement
    {
        if ($this->lastMethod !== 'groupBy') {
            return $this;
        }

        $this->selectQuery .= " HAVING $condition";
        $this->selectQueryBinds += $conditionBinds;
        $this->lastMethod = 'having';
        return $this;
    }
}
