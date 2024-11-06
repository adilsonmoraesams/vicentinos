<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use Core\Controller;

class AuthController extends Controller
{
    public function login()
    {
        // Renderiza a view de login
        $this->view('auth/login');
    }

    public function authenticate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST['email'];
            $password = md5( SECRET_KEY .$_POST['password']);

            $UsuarioModel = new UsuarioModel();
            $usuario = $UsuarioModel->Login($email, $password);

            if ($usuario) {
                $_SESSION['user_id'] = $usuario["id"];
                $_SESSION['user_nome'] = $usuario["nome"];
                $_SESSION["mensagem"] = "";

                // Redireciona para o Dashboard
                header('Location: /');
                exit;
            } else {
                $_SESSION["mensagem"] = "<div class='alert alert-danger'>Usuário/senha inválido.</div>";
            }
        }

        $this->view('auth/login');
    }

    public function logout()
    {
        // Destroi a sessão do usuário
        session_destroy();

        // Redireciona para a página de login
        header('Location: /login');
        exit;
    }
}
