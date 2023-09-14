<?php

declare(strict_types=1);

namespace App\Utils\Abstracts;

use PDO;
use App\Utils\Database;
use App\Utils\Statements\SelectStatement;

abstract class AbstractModel
{
    protected string $tableName;
    protected const TABLE_NAME = null;
    protected Database $database;

    /**
     * Constructor to initialize the database connection and table name.
     *
     * @param PDO $connection The PDO database connection.
     */
    public function __construct(PDO $connection)
    {
        $this->database = new Database($connection);
        $this->tableName = static::TABLE_NAME ?? $this->getTableName($this);
    }

    /**
     * Get the table name based on the class name.
     *
     * @param AbstractModel $instance The instance of the model.
     *
     * @return string The table name.
     */
    private function getTableName(AbstractModel $instance): string
    {
        $fullName = get_class($instance);

        $fullNameArray = explode('\\', $fullName);
        $tableName = end($fullNameArray);

        return strtolower($tableName);
    }

    /**
     * Enumerates the column values for parameter binding.
     *
     * @param array $object The associative array of column values.
     *
     * @return array An associative array of enumerated column values.
     */
    private function enumerateColumnValues(array $object): array
    {
        $columnValues = [];
        $counter = 1;

        foreach ($object as $key => $value) {
            $columnValues[":$counter"] = $value;
            $counter++;
        }

        return $columnValues;
    }

    /**
     * Create a new SelectStatement instance for building SELECT queries.
     *
     * @param string $columns The columns to select (default is "*").
     *
     * @return SelectStatement A SelectStatement instance for building SELECT queries.
     */
    public function select(string $columns = "*"): SelectStatement
    {
        return new SelectStatement($columns, $this->tableName, $this->database);
    }

    /**
     * Insert data into the table.
     *
     * @param array $object An associative array of column values to insert.
     * @param bool $onDuplicateKeys Whether to perform an "INSERT ... ON DUPLICATE KEY UPDATE" operation.
     *
     * @return bool True if the insert operation was successful, otherwise false.
     */
    public function insert(array $object = [], bool $onDuplicateKeys = false): bool
    {
        $columnNames = array_keys($object);
        $columns = implode(", ", $columnNames);
        $enumeratedBinds = $this->enumerateColumnValues($object);
        $columnBindNumbers = implode(", ", array_keys($enumeratedBinds));

        $query = "INSERT INTO $this->tableName ($columns) VALUES ($columnBindNumbers)";

        if ($onDuplicateKeys) {
            $columnsArray = [];
            $arraySize = count($columnNames);

            $counter = 1;
            foreach ($enumeratedBinds as $key => $value) {
                $enumeratedBinds[':' . ($arraySize + $counter)] = $value;
                $counter++;
            }

            $columnNumbers = array_keys($enumeratedBinds);

            for ($i = 0; $i < $arraySize; $i++) {
                $column = $columnNames[$i] . ' = ' . $columnNumbers[$i + $arraySize];
                array_push($columnsArray, $column);
            }

            $columnValues = implode(', ', $columnsArray);

            $query .= " ON DUPLICATE KEY UPDATE $columnValues";
        }

        $result = $this->database->directPrepare($query, $enumeratedBinds);

        return $result;
    }

    /**
     * Update data in the table.
     *
     * @param array $object An associative array of column values to update.
     *
     * @return bool True if the update operation was successful, otherwise false.
     */
    public function update(array $object = []): bool
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

    /**
     * Delete data from the table based on a condition.
     *
     * @param string $condition The WHERE condition for the DELETE operation.
     * @param array $conditionBinds An associative array of parameter bindings for the condition.
     *
     * @return bool True if the delete operation was successful, otherwise false.
     */
    public function delete(string $condition = '0 > 1', array $conditionBinds = []): bool
    {
        $query = "DELETE FROM $this->tableName WHERE $condition";

        $result = $this->database->directPrepare($query, $conditionBinds);

        return $result;
    }
}
