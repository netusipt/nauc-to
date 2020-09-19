<?php
declare(strict_types = 1);

use controller\Router;

spl_autoload_register(function (string $path) {
    $class = explode("\\", $path);
    if($class[count($class) - 1][0] != "I") {
        require_once "$path.class.php";
    } else {
        require_once "$path.interface.php";
    }
});

$router = new Router();
$router->process([$_SERVER["REQUEST_URI"]]);
$router->render();