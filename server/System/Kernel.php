<?php



/********************* CORS **********************/

if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
    }
    exit(0);
}




// function validaCampoObrigatorio($campo = null, $mensagem = "Campo obrigatório não preenchido")
// {
//     if (!isset($campo) || $campo == "" || $campo == null) {
//         header('HTTP/1.0 422 Unprocessable Entity', true, 422);
//         $array = array("code" => 422, "status" => false, "message" => $mensagem);
//         echo json_encode($array);
//         die();
//     }
// }

function dataEnv()
{
    return  parse_ini_file( $_SERVER['DOCUMENT_ROOT'] . '/.env');
}

 
$_ENV = dataEnv();





/********************** AUTENTICAÇÃO **********************
$username = null;
$password = null;
$mod = NULL;

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
    if ($username != $env["SERVER_USR"] || $password != $env["SERVER_PASS"]) :
        header('WWW-Authenticate: Basic realm="Sistema de Testes"');
        header('HTTP/1.0 401 Unauthorized');
        die('Acesso negado.');
    endif;
endif;
*/