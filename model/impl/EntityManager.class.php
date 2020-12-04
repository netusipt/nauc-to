<?php
declare(strict_types = 1);

namespace model\impl;

use model\AModel;
use model\AModelManager;
use util\db\NameConvertor;
use util\Helper;
use util\db\MySQLDriver;

class EntityManager
{
    private static $object;

    private AModel $entity;
    private MySQLDriver $db;

    public static function getInstance(AModel $entity)
    {
        if(self::$object == null) {
            self::$object = new EntityManager();
        }

        self::$object->entity = $entity;

        return self::$object;
    }

    private function __construct()
    {
        $this->db = MySQLDriver::getInstance();
    }

    public function getAll() : array
    {
        $entities = [];
        $result = $this->db->selectAll($this->entity->table);
        foreach ($result as $entity) {
            $entities[] = $this->convert($entity);
        }
        return $entities;
    }

    public function search(string $searchProperty, string $searched) : array
    {
        $entities = [];
        $result = $this->db->selectLike($this->entity->table, $searchProperty, $searched);
        foreach ($result as $entity) {
            $entities[] = $this->convert($entity);
        }
        return $entities;
    }

    public function convert(array $entities)
    {
        $class = get_class($this->entity);
        $entity = new $class();
        foreach ($entity->getPropertyNames() as $property) {
            $setter = Helper::setter($property);
            $entity->$setter($entities[NameConvertor::classToDb($property)]);
        }
        return $entity;
    }



}