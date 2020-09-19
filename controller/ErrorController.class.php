<?php
declare(strict_types = 1);

namespace controller;

class ErrorController extends AController
{
    public function process($params)
    {
        header("HTTP/1.0 404 Not Found");
        $this->view = "error";
    }
}