<?php
declare(strict_types = 1);

namespace controller;

abstract class AController
{
    protected $view;
    protected $data = [];

    public abstract function process($params);

    public function render()
    {
        if($this->view != "") {
            extract($this->data);
            require("View/" . $this->view . ".phtml");
        }
    }

    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }
}