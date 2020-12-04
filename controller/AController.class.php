<?php
declare(strict_types = 1);

namespace controller;

abstract class AController
{
    protected string $view;
    protected array $data = [];

    public abstract function process($params);

    public function render()
    {
        if($this->view != "") {
            extract($this->data);
            require("View/" . $this->view . ".phtml");
        }
    }

    public function redirect($url = "")
    {
        var_dump(HOME_PATH . $url);
        header("Location:" . HOME_PATH . $url);
        header("Connection: close");
        exit;
    }
}