<?php
declare(strict_types=1);

namespace model;

use util\db\APDODriver;

abstract class AModel extends APDODriver implements IModel
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