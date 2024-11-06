<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
error_reporting(1);
ini_set('error_reporting', E_ALL);
 
require_once 'vendor/autoload.php';
require_once 'config/config.php';


use Core\Router;

$router = new Router();

require_once 'routes/web.php';

$router->dispatch($_SERVER['REQUEST_URI']);
