<?php
declare(strict_types = 1);

namespace Model\Impl;

use Model\AModelManager;
use Util\Helper;
use Util\MySQLDriver;

class EntityManager
{
    private static $object;

    private string $table;
    private MySQLDriver $db;

    public static function getInstance(string $table)
    {
        if(self::$object == null) {
            self::$object = new EntityManager();
        }

        self::$object->setTable($table);

        return self::$object;
    }

    private function __construct()
    {
        $this->db = MySQLDriver::getInstance();
    }

    public function getAll() : array
    {
        $entities = [];
        $result = $this->db->selectAll($this->table);
        foreach ($result as $entity) {
            $entities[] = $this->convert($entity);
        }
        return $entities;
    }

    public function search(string $searchProperty, string $searched) : array
    {
        $entities = [];
        $result = $this->db->selectLike($this->table, $searchProperty, $searched);
        foreach ($result as $entity) {
            $entities[] = $this->convert($entity);
        }
        return $entities;
    }

    public function convert(array $entities)
    {
        $entity = new $this->container["entityInfo"][$this->table]["model"]();
        foreach ($entity->vratNazvyAtributu() as $atribut) {
            $setter = Helper::setter($atribut);
            $entity->$setter($entities[$atribut]);
        }
        return $entity;
    }

    public function setTable($table)
    {
        $this->table = $table;
    }

}