<?php
declare(strict_types = 1);

namespace controller;

use model\impl\EntityManager;
use model\impl\Offer;


class HomeController extends AController
{
    public function process($params)
    {
        $offer = new Offer();
        $this->data["offers"] = $offer->getAll();
        $this->view = "home";
    }
}