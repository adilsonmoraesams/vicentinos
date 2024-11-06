<?php

namespace App\Models;

use PDO;
use PDOException;

class UsuarioModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Read by ID
    public function Login($email, $senha)
    {
        $sql = " SELECT * FROM usuario WHERE email = :email AND senha = :senha ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
        $stmt->execute();

        // $stmt->debugDumpParams();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
