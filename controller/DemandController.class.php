<?php
declare(strict_types = 1);

namespace controller;

use model\impl\Demand;

class DemandController extends AController
{
    public function process($params)
    {
        $demand = new Demand();

        if($params[0] == "list") {
            $this->data["demands"] = $demand->getAll();
            $this->view = "demandList";
        } else if($params[0] == "new") {
            $this->view = "createDemand";
        } else if($params[0] == "my-listing") {
            $this->view = "myListing";
        }
        else {
            $this->data = $demand->get($params[0]);
            $this->view = "demand";
        }
    }
}