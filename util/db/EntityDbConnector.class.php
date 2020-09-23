<?php
declare(strict_types = 1);

use util\DatabaseDto;
use util\Helper;
use util\MySQLDriver;

namespace util;

class EntityDbConnector
{
    private $db;

    public function __construct(DatabaseDto $dbDto)
    {
        $this->db = MySQLDriver::getInstance($dbDto);
    }

    public function load($entity, $property, $value)
    {
        $result = $this->db->select($entity->table, $property, $value);

        foreach ($entity->getPropertyNames() as $property) {
            $setter = Helper::setter($property);
            $entity->$setter($result[$property], true);
        }

        return $entity;
    }

    public function insert($entity)
    {
        $properties = $entity->getPropeties();
        unset($properties["id"]);
        $this->db->insert($entity->table, $properties);
    }

    public function delete($entity, $id)
    {
        $this->db->delete($entity->table, $id);
    }

    public function update($entity, $id)
    {
        $this->db->update($entity->table, $entity->getPropeties(), $id);
    }

}