<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
require __DIR__ . '/vendor/autoload.php';
require_once(__DIR__ . '/System/Authenticate.php');
require_once("System/Kernel.php");
// require_once("System/Autoload.php");
// $autoload = new Autoload();
  
// require_once(__DIR__ . '/System/Database.php');
// require_once(__DIR__ . '/System/Router.php');
// require_once(__DIR__ . '/System/BaseApi/Request.php');
// require_once(__DIR__ . '/System/BaseApi/Response.php');
// require_once(__DIR__ . '/System/Helper/JsonHelper.php');
require_once(__DIR__ . '/Routes.php');