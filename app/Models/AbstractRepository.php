<?php

declare(strict_types=1);

namespace App\Models;

use PDO;
use App\Services\Database;

abstract class AbstractRepository
{
    private $database;
    private $tableName;

    public function __construct(PDO $connection)
    {
        $this->database = new Database($connection);
        $this->tableName = $this->getTableName($this);
    }

    private function getTableName($instance)
    {
        $fullName = get_class($instance);

        $fullNameArray = explode('\\', $fullName);
        $tableName = end($fullNameArray);

        return strtolower($tableName);
    }

    private function enumerateColumnValues(array $object)
    {
        $columnValues = [];
        $counter = 1;

        foreach ($object as $key => $value) {
            $columnValues[":$counter"] = $value;
            $counter++;
        }

        return $columnValues;
    }

    public function selectAll(string $columns = '*', bool $fetchAll = true)
    {
        $query = "SELECT $columns FROM $this->tableName";

        $data = $this->database->dataQuery($query, $fetchAll);

        return $data;
    }

    public function selectWhere(string $condition = "1 = 1", array $conditionBinds = [], string $columns = "*", bool $fetchAll = true)
    {
        $query = "SELECT $columns FROM $this->tableName WHERE $condition";

        $data = $this->database->dataPrepare($query, $conditionBinds, $fetchAll);

        return $data;
    }

    public function insert(array $object = [])
    {
        $columns = implode(", ", array_keys($object));
        $enumeratedBinds = $this->enumerateColumnValues($object);
        $columnBindNumbers = implode(", ", array_keys($enumeratedBinds));

        $query = "INSERT INTO $this->tableName ($columns) VALUES ($columnBindNumbers)";

        $result = $this->database->directPrepare($query, $enumeratedBinds);

        return $result;
    }

    public function update(array $object = [])
    {
        $columnNames = array_keys($object);
        $enumeratedBinds = $this->enumerateColumnValues($object);
        $columnBinds = array_keys($enumeratedBinds);

        $columnsArray = [];

        $condition = $columnNames[0] . ' = ' . $columnBinds[0];

        for ($i = 1; $i < count($columnBinds); $i++) {
            $column = $columnNames[$i] . ' = ' . $columnBinds[$i];
            array_push($columnsArray, $column);
        }

        $columns = implode(', ', $columnsArray);

        $query = "UPDATE $this->tableName SET $columns WHERE $condition";

        $result = $this->database->directPrepare($query, $enumeratedBinds);

        return $result;
    }

    public function delete(string $condition = '0 > 1', array $conditionBinds = [])
    {
        $cmd = "DELETE FROM $this->tableName WHERE $condition";

        $result = $this->database->directPrepare($cmd, $conditionBinds);

        return $result;
    }
}