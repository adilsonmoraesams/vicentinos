<?php

/* Área restrita */
$router->add('/login', ['controller' => 'AuthController', 'action' => 'login']);
$router->add('/authenticate', ['controller' => 'AuthController', 'action' => 'authenticate']);
$router->add('/logout', ['controller' => 'AuthController', 'action' => 'logout']);

$router->add('/', [
    'controller' => 'DashboardController',
    'action' => 'index',
    'middleware' => 'auth'
]);

// Membros 
$router->add('/membros', ['controller' => 'MembrosController',    'action' => 'index',    'middleware' => 'auth']);
$router->add('/membros/cadastrar', ['controller' => 'MembrosController', 'action' => 'cadastrar', 'middleware' => 'auth']);
$router->add('/membros/editar', ['controller' => 'MembrosController', 'action' => 'editar', 'middleware' => 'auth']);
$router->add('/membros/excluir', ['controller' => 'MembrosController', 'action' => 'excluir', 'middleware' => 'auth']);


// Filmes
$router->add('/admin/filmes', ['controller' => 'FilmesController',    'action' => 'index',    'middleware' => 'auth']);
$router->add('/admin/filmes/cadastrar', ['controller' => 'FilmesController', 'action' => 'cadastrar', 'middleware' => 'auth']);
$router->add('/admin/filmes/editar', ['controller' => 'FilmesController', 'action' => 'editar', 'middleware' => 'auth']);
$router->add('/admin/filmes/excluir', ['controller' => 'FilmesController', 'action' => 'excluir', 'middleware' => 'auth']);

// Contato
$router->add('/admin/contatos', ['controller' => 'ContatoController',    'action' => 'index',    'middleware' => 'auth']);
$router->add('/admin/contatos/visualizar', ['controller' => 'ContatoController',    'action' => 'visualizar',    'middleware' => 'auth']);