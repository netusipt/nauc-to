<?php
declare(strict_types = 1);

namespace controller;

class AdminController extends AController
{
    public function process($params)
    {
        if(isset($params[0])) {
            if($params[0] == "demand") {
                $this->view = "admin";
            }
        }
        $this->view = "admin";
    }
}