<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

// FRONT-CONTROLLER
$router = new Router();
$router->route();

?>