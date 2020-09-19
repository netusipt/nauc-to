<?php
declare(strict_types = 1);

namespace controller;

class Router extends AController
{
    protected $controller;

    public function process($params)
    {
        $urlArray = $this->parseUrl($params[0]);

        if(!empty($urlArray[3])) {
            $controllerName = "Controller\\" . ucfirst(array_shift($urlArray)) . "Controller";
        } else {
            $controllerName = "Controller\HomeController";
        }

        if(file_exists("$controllerName.class.php")) {
            $this->controller = new $controllerName();
        } else {
            $this->controller = new ErrorController();
        }

        $this->controller->process($urlArray);
        $this->view = "layout";
    }

    private function parseUrl($url)
    {
        $path = parse_url($url)["path"];
        $path = ltrim($path, "/");
        $splitUrl = explode("/", $path);
        for ($i=0; $i < 3; $i++) { 
            unset($splitUrl[$i]);
        }
        return $splitUrl;
    }
}