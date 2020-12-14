<?php
declare(strict_types = 1);

namespace controller;

class OfferController extends AController
{
    public function process($params)
    {
        if($params[0] == "list") {
            $this->view = "offerList";
        }
        
        else if($params[0] == "new") {
            $this->view = "createOffer";
        }

        else if($params[0] == "my-listing") {
            $this->view = "myListing";
        }
        
        else {
            $this->view = "offer";
        }

    }
}