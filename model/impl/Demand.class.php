<?php
namespace model\impl;

use model\AModel;

class Demand extends AModel
{
    private $title;
    private $description;

    public function get($id)
    {
        $sql = "SELECT demand.id, demand.description, title, first_name, last_name FROM demand
        INNER JOIN users ON demand.user_id = users.id
        WHERE demand.id = $id";
        return $this->query($sql, true);
    }

    public function getAll() {
        $sql = "SELECT demand.id, demand.description, title, first_name, last_name FROM demand 
                JOIN users ON demand.user_id = users.id";

        return $this->query($sql, true, true); 
    }

    public function getPropertyNames(): array
    {
        return array_keys($this->getProperties());
    }

    public function getProperties(): array
    {
        $properties = get_object_vars($this);
        unset($properties["table"]);
        return $properties;
    }
}