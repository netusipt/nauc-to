<?php
declare(strict_types = 1);

namespace util\db;

use util\Helper;

class EntityDbConnector
{
    private MySQLDriver $db;
    private PropertyNameConvertor $propertyConvertor;

    public function __construct()
    {
        $this->db = MySQLDriver::getInstance();
        $this->propertyConvertor = new PropertyNameConvertor();
    }

    public function load($entity, $property, $value)
    {
        $result = $this->db->select($entity->table, $property, $value);

        foreach ($entity->getPropertyNames() as $property) {
            $setter = Helper::setter($this->propertyConvertor->dbToClass($property));
            $entity->$setter($result[$property], true);
        }

        return $entity;
    }

    public function insert($entity)
    {
        $properties = $entity->getProperities();
        unset($properties["id"]);
        $properties = $this->propertyConvertor->classToDbAll($properties);
        $this->db->insert($entity->table, $properties);
    }

    public function delete($entity, $id)
    {
        $this->db->delete($entity->table, $id);
    }

    public function update($entity, $id)
    {
        $properties = $this->propertyConvertor->classToDbAll($entity->getProperities());
        $this->db->update($entity->table, $properties, $id);
    }



}