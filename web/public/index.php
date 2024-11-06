<?php


echo phpinfo();
exit;

require_once '../vendor/autoload.php';
require_once '../config/config.php';

use Core\Router;

$router = new Router();

require_once '../routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI']);
