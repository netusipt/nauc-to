<?php
declare(strict_types = 1);

namespace controller;

class ExceptionController extends AController
{
    private int $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function process($params)
    {
        $this->data["code"] = $this->code;

        switch ($this->code) {
            case 404:
                $this->data["message"] = "Požadovaná stránka nebyla nalezena.";
                break;
        }
        $this->view = "exception";
    }
}