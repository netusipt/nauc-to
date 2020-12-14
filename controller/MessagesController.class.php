<?php
declare(strict_types = 1);

namespace controller;

class MessagesController extends AController
{
    public function process($params)
    {
        if(!isset($params[0])) {
            $this->view = "messages";
        } else {
            $this->view = "message";
        }
    }
}