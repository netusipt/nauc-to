<?php
declare(strict_types = 1);

namespace model;

class Offer {

    private int $id;
    private int $userId;
    private string $title;
    private string $description;
    private int $categoryId;
    private int $locationId;
}