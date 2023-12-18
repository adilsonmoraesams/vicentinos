<?php


namespace Controller;

// use ControllerApi;

class ModeloController //extends Request
{

    public function __construct()
    {
        echo 'aaa';
        // parent::__construct();
    }

    public static function Index()
    {
        echo 33;
        exit;
        echo "Index";

        return;
    }

    public static function Cadastrar()
    {
        echo "Cadastrar";
    }


    public static function Editar()
    { 
        // print_r(parent::$request);

        echo "Index";
    }


    public static function Excluir()
    {
        echo "Index";
    }
}
