<?php


namespace Controller;

use App\Data\AuthRepository;
use App\Models\Usuario;
use Exception;
use System\BaseApi\EnumRequestValidacao;
use System\BaseApi\Request;
use System\BaseApi\Response;
use System\JWT;
use System\Logs;


class AuthController extends Request
{
    protected $AuthRepository;
    protected $request;

    public function __construct()
    {
        $this->AuthRepository = new AuthRepository();
        $this->request = new Request();
    }

    /*
     * Logar
    */
    public function Login()
    {
        try {
            $usuario = new Usuario();
            $usuario->Email = parent::post("email", EnumRequestValidacao::Obrigatorio);
            $usuario->Senha = md5(parent::post("senha", EnumRequestValidacao::Obrigatorio));

            $result = $this->AuthRepository->Login($usuario);

            if (!$result) {
                return Response::HttpResponseErrorNotAuthorized("Usuário e/ou senha inválidos.");
            }

            $result["Senha"] = "";

            $jwt = new JWT();
            $token = $jwt->encode($result, $_ENV["SECRET_KEY"]); // Tempo de expiração

            return Response::HttpResponseOK($token);
        } catch (Exception $e) {
            return Response::HttpResponseErrorBadRequest($e->getMessage());
        }
    }
}
