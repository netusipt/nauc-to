<?php
declare(strict_types = 1);

namespace util;

class MySQLDriver extends APDODriver
{

    private static $instace;

    public static function getInstance(DatabaseDto $db)
    {
        if(self::$instace == null) {
            self::$instace = new MySQLDriver($db);
        }
        return self::$instace;
    }

    private function __construct(DatabaseDto $db)
    {
        $db->setTyp("mysql");
        parent::__construct($db);
    }

    public function select(string $table, string $property,  $value)
    {
        $sql = "SELECT * FROM $table WHERE $property='$value'";
        return $this->query($sql, true);
    }

    public function selectAll(string $table)
    {
        $sql = "SELECT * FROM $table";
        return $this->query($sql, true, true);
    }

    public function selectLike(string $table, string $property, string $value)
    {
        $sql = "SELECT * FROM $table WHERE $property LIKE '%$value%'";
        return $this->query($sql, true, true);
    }

    public function insert(string $table, array $properties)
    {
        $sql = "INSERT INTO $table (";
        foreach (array_keys($properties) as $name) {
            $sql .= "$name, ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ") VALUES (";

        foreach($properties as $value) {
            $sql .= "'$value', ";
        }
        $sql = rtrim($sql, ", ");
        $sql .= ");";

        $this->query($sql);
    }

    public function delete(string $table ,int $id)
    {
        $sql = "DELETE FROM $table WHERE id=$id";
        $this->query($sql);
    }

    public function update(string $table, array $properties, $id)
    {
        $sql = "UPDATE $table SET ";

        foreach ($properties as $key => $property) {
            $sql .= "$key='$property', ";
        }
        $sql = rtrim($sql, ", ");

        $sql .= "WHERE id=$id";

        $this->query($sql);
    }
}