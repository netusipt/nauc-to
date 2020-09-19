<?php
declare(strict_types = 1);

namespace controller;

class HomeController extends AController
{
    public function process($params)
    {
        $this->view = "home";
    }
}