<?php

declare(strict_types=1);

namespace model\impl;

use model\AModel;

class Offer extends AModel
{

    private $userId;
    private $title;
    private $description;
    private $categoryId;
    private $locationId;
    private $photo;


    public function __construct()
    {
        $this->table = "offers";
        parent::__construct();
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function get($id)
    {
        $sql = "SELECT  FROM offers
        JOIN users ON offers.user_id = users.id
        JOIN categories ON offers.category_id = categories.id
        JOIN locations ON offers.location_id = locations.id
        WHERE offers.id = $id";
        return $this->query($sql, true);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM offers
                JOIN users ON offers.user_id = users.id
                JOIN categories ON offers.category_id = categories.id
                JOIN locations ON offers.location_id = locations.id";
        return $this->query($sql, true, true);
    }

    public function getPropertyNames()
    {
        return array_keys($this->getProperties());
    }

    public function getProperties()
    {
        $properties = get_object_vars($this);
        unset($properties["table"]);
        return $properties;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }


    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function setLocationId($locationId): void
    {
        $this->locationId = $locationId;
    }

    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }
}
