<?php


namespace Fira\Infrastructure\Database\Sql\Mysql;


use Fira\Infrastructure\Database\Sql\AbstractSqlDriver;
use mysqli;
use RuntimeException;

class MySqlDriver extends AbstractSqlDriver
{
    public function __construct(string $host, string $username, string $password, string $dbName, int $port)
    {
        $this->connection = new mysqli($host, $username, $password, $dbName, $port);
        $this->connection->select_db($dbName);
    }

    public function getRowById(int $id, string $table): array
    {
        $rows = $this->select(['*'], $table, 'id = ' . $id);
        if (empty($rows) || !isset($rows[0])) {
            throw new RuntimeException('Row with Id ' . $id . ' not found.');
        }

        return $rows[0];
    }

    public function select(array $field, string $table, string $where): array
    {
        if (empty($field)) {
            throw new RuntimeException('Fields should not be empty');
        }

        if (isset($field[0]) && $field[0] === '*') {
            $fieldString = '*';
        } else {
            $fieldString = implode(',', $field);
        }

        $query = <<<sql
SELECT {$fieldString} FROM {$table} WHERE {$where}; 
sql;

        $mysqlResult = $this->connection->query($query);
        return $mysqlResult->fetch_array();
    }

    public function update(string $query): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(string $query): bool
    {
        // TODO: Implement delete() method.
    }

    public function insert(string $query): bool
    {
        // TODO: Implement insert() method.
    }
}