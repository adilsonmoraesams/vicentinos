<?php

namespace App\Data;

use App\Models\Usuario;
use Exception;
use PDO;
use PDOException;
use System\Database;
use System\Logs;

class AuthRepository
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getInstance();
    }



    /* 
    * Listar todos
    */
    public function Login(Usuario $usuario)
    {
        try {

            $stmt = $this->conn->prepare(' SELECT * FROM Usuario
             WHERE email = :email 
             AND  senha = :senha ');
            $stmt->bindValue(':email', $usuario->Email);
            $stmt->bindValue(':senha', $usuario->Senha);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao consultar editar cliente:' . $e->getMessage());
        }
    }



}