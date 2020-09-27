<?php
declare(strict_types = 1);

namespace controller;

class ErrorController extends AController
{
    public function process($params)
    {
        $this->view = "error";
    }
}