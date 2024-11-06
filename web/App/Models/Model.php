<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{
    protected $db;

    public function __construct()
    {

        try {
            $host = DB_HOST;  // Ou use 'localhost'
            $port = DB_PORT;
            $dbname = DB_NAME;  // Nome do banco de dados (ajuste conforme necessário)
            $username = DB_USER;
            $password = DB_PASS;

            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
            $this->db = new PDO($dsn, $username, $password);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Captura e exibe o erro de conexão
            echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->db;
    }
}
