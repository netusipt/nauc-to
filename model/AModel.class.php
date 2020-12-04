<?php
declare(strict_types=1);

namespace model;


abstract class AModel implements IModel
{
    protected $id;
    protected $table;

    public function setId($id) : void
    {
        $this->id = $id;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}