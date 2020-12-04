<?php
declare(strict_types = 1);

namespace model\impl;

use model\AModel;

class Offer extends AModel {

    private $userId;
    private $title;
    private $description;
    private $categoryId;
    private $locationId;
    private $photo;


    public function __construct() {
        $this->table = "offers";
    }

    public function __get($name)
    {
        return $this->$name;
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