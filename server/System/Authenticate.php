<?php

namespace System;

use Exception;
use System\BaseApi\Response;

class Authenticate
{
    protected $tipo;

    public function __construct($tipoAuth)
    {
        $this->tipo = $tipoAuth;
        /*
        switch($tipo){
            case EnumTypeAuth::Basic: $this->Basic();
        }
        /* 
        
        */
    }

    public function Proteger()
    {
        switch ($this->tipo) {
            case EnumTypeAuth::Basic:
                $this->Basic();
        }
    }


    public function Basic()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_USER'] == "")
            return Response::HttpResponseErrorNotAuthorized("Usuário não informado");

        if (!isset($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_PW'] == "")
            return Response::HttpResponseErrorNotAuthorized("Senha não informada");

        // Método para mod_php (Apache)
        if (isset($_SERVER['PHP_AUTH_USER'])) :
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];
            $mod = 'PHP_AUTH_USER';

        // Método para demais servers
        elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) :

            if (preg_match('/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
                list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));

            $mod = 'HTTP_AUTHORIZATION';

        endif;

        // Se a autenticação não foi enviada
        if (is_null($username)) :

            header('WWW-Authenticate: Basic realm="Sistema de Testes"');
            header('HTTP/1.0 401 Unauthorized');
            die('Acesso negado.');

        elseif (is_null($password)) :

            header('WWW-Authenticate: Basic realm="Sistema de Testes"');
            header('HTTP/1.0 401 Unauthorized');
            die('Acesso negado.');

        // Se houve envio dos dados
        else :
            if ($username != $_ENV["SERVER_USR"] || $password != $_ENV["SERVER_PASS"]) :
                header('WWW-Authenticate: Basic realm="Sistema de Testes"');
                header('HTTP/1.0 401 Unauthorized');
                die('Acesso negado.');
            endif;
        endif;
    }
}



class EnumTypeAuth
{
    public const Basic = 1;
    const Bearer = 2;
}


class EnumProtect 
{
    const Private = 1;
    const Public = 2;
}