<?php

use Controller\ClientesController;
use System\EnumProtect;
use System\EnumTypeAuth;
// use Controller\ModeloController;
use System\Router;
  
$router = new Router;
$router->Authenticate(EnumTypeAuth::Basic);
$router->Proteger(EnumProtect::Private);
 

$router->addRoute('GET', '/clientes', function () { 
    (new ClientesController)->Listar();
 });
 
$router->addRoute('GET', '/clientes/:id', function ($id) {
    (new ClientesController)->Consultar($id);
});
 
$router->addRoute('POST', '/clientes/cadastrar', function () {
    (new ClientesController)->Cadastrar();
});

$router->addRoute('PUT', '/clientes/editar/:id', function ($id) {    
    // echo $id;
    (new ClientesController)->Editar($id);
});

$router->addRoute('DELETE', '/clientes/:id', function ($id) {    
    // echo $id;
    (new ClientesController)->Excluir($id);
});

$router->matchRoute();
