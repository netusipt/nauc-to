<?php
declare(strict_types = 1);

namespace util\db;

use util\Helper;

class EntityDbConnector
{
    private MySQLDriver $db;

    public function __construct()
    {
        $this->db = MySQLDriver::getInstance();
    }

    public function load($entity, $property, $value)
    {
        $result = $this->db->select($entity->table, $property, $value);

        foreach ($entity->getPropertyNames() as $property) {
            var_dump($property);
            $setter = Helper::setter($property);
            $entity->$setter($result[NameConvertor::classToDb($property)], true);
        }

        return $entity;
    }

    public function insert($entity)
    {
        $properties = $entity->getProperties();
        unset($properties["id"]);
        $properties = NameConvertor::classToDbAll($properties);
        $this->db->insert($entity->table, $properties);
    }

    public function delete($entity, $id)
    {
        $this->db->delete($entity->table, $id);
    }

    public function update($entity, $id)
    {
        $properties = NameConvertor::classToDbAll($entity->getProperities());
        $this->db->update($entity->table, $properties, $id);
    }



}