<?php


namespace model\impl;


use model\AModel;

class Category extends AModel
{
    private $name;

    public function getPropertyNames()
    {
        // TODO: Implement getPropertyNames() method.
    }

    public function getProperties()
    {
        // TODO: Implement getProperties() method.
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}