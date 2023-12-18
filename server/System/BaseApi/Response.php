<?php

namespace System\BaseApi;

use JsonHelper;

class Response
{
    public static function HttpResponseOK($message = array())
    {
        header('Status: 200 OK');

        if (JsonHelper::json_validator($message)) {
            echo $message;
            die();
        }

        echo json_encode($message);
        die();
    }

    public static function HttpResponseErrorMissing($message = array())
    {
        header('Status: 412 Precondition Failed');

        if (JsonHelper::json_validator(
            array(
                "status" => false,
                "message" => $message
            )
        )) {
            die();
        }

        echo json_encode(
            array(
                "status" => false,
                "message" => $message
            )
        );
        die();
    }


    public static function HttpResponseErrorBadRequest($message = array())
    {
        header('HTTP/1.1 400 Bad Request', true, 400);

        if (JsonHelper::json_validator(
            array(
                "status" => false,
                "message" => $message
            )
        )) {
            die();
        }

        echo json_encode(
            array(
                "status" => false,
                "message" => $message
            )
        );
        die();
    }


    public static function HttpResponseErrorBadRequestValid($campo = "")
    {
        header('HTTP/1.0 422 Unprocessable Entity', true, 422);
        $array = array("code" => 422, "status" => false, "message" => "Campo {$campo} obrigatório não preenchido");
        echo json_encode($array);
        die();
    }

    public static function HttpResponseErrorNotAuthorized($message = "")
    {
        header('HTTP/1.0 401 Unauthorized', true, 401);
        $array = array("code" => 401, "status" => false, "message" => $message);
        echo json_encode($array);
        die();
    }
}
