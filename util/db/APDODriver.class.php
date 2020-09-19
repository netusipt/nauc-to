<?php

declare(strict_types=1);

namespace util\Db;

use PDO;
use PDOException;

abstract class APDODriver
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . DbConfig::$HOST .
                ";port=" . DbConfig::$PORT . 
                ";dbname=" . DbConfig::$DB_NAME .
                ";charset=utf8",
                DbConfig::$USER,
                DbConfig::$PASSWORD
            );
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage());
        }

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function query(string $sql, bool $fetch = false, $all = false)
    {
        try {
            $result = $this->pdo->prepare($sql);
            $result->execute();
        } catch (PDOException $e) {
            throw new PDOException("Chyba SQL dotazu: " . $e->getMessage());
        }

        if($fetch) {
            if($all) {
                return $result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $result->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
}
