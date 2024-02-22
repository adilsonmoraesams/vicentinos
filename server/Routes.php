<?php

use Controller\AuthController;
use Controller\ClientesController;
use System\EnumProtect;
use System\EnumTypeAuth;
// use Controller\ModeloController;
use System\Router;
  
$router = new Router;
$router->Authenticate(EnumTypeAuth::Bearer);
$router->Proteger(EnumProtect::Private);
 

// Login
$router->addRoute('POST', '/auth/login', function () { ( new AuthController)->Login(); }, EnumProtect::Public);


// Clientes
$router->addRoute('GET', '/clientes', function () { ( new ClientesController)->Listar(); });
$router->addRoute('GET', '/clientes/:id', function ($id) { (new ClientesController)->Consultar($id); });
$router->addRoute('POST', '/clientes/cadastrar', function () { (new ClientesController)->Cadastrar(); });
$router->addRoute('PUT', '/clientes/editar/:id', function ($id) { (new ClientesController)->Editar($id); });
$router->addRoute('DELETE', '/clientes/:id', function ($id) { (new ClientesController)->Excluir($id); });

$router->matchRoute();
