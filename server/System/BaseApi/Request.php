<?php


namespace System\BaseApi;

use Exception;

class Request
{

    public static function get($name = null, $tipo = null)
    {
        $data = $_REQUEST;

        if(!isset($data[$name])) $data[$name] = "";

        if (!is_null($name)) {
            $data[$name] =  htmlspecialchars($data[$name]);
        }

        $msg = "Conteúdo de \"{$name}\" está em formato inválido";
        switch($tipo){
            case EnumRequestTipo::int: 
                if(Validate::ValidateInt($data[$name]))
                {
                    return (int) $data[$name];
                } else {
                    throw new Exception($msg, 500);
                }
                break;
        }
 
        return $data[$name];
    }

    public static function post($name = null, $valid = "")
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $name = strtolower($name);

        if(!isset($data[$name])) $data[$name] = "";
        
        if($valid == EnumRequestValidacao::Obrigatorio
        && ($data[$name] == null || $data[$name] == "")){
            return Response::HttpResponseErrorBadRequestValid($name);
        }else{
            return  $data[$name];
        }

        // if (!is_null($name) && !is_null($data)) 
        // {
        //     return  $data[$name];
        // }

        return $data;
    }

    public static function valid($campo = null, $mensagem = "Campo obrigatório não preenchido")
    {
        if (!isset($campo) || $campo == "" || $campo == null) {
            header('HTTP/1.0 422 Unprocessable Entity', true, 422);
            $array = array("code" => 422, "status" => false, "message" => $mensagem);
            echo json_encode($array);
            die();
        }
    }
}


class Validate{

    public static function ValidateInt($valor){
        if(!is_numeric($valor)) 
            return false;

        return true;
    }
}


class EnumRequestValidacao
{
    const Obrigatorio = 1;
    const Email = 1;
}

class EnumRequestTipo
{
    const int = 1;
    const string = 2;
    const Date = 31;
    
}

