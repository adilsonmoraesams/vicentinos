<?php

namespace App\Models;

use Exception;
use PDO;
use PDOException;

class CategoriaModel extends Model
{

    public function __construct()
    {
        parent::__construct(); // Chama o construtor da classe Model para conectar ao banco
    }

    // Read all
    public function getAll()
    {
        try {
            // Adiciona a cláusula LIMIT e OFFSET para a paginação
            $sql = "SELECT * FROM categoria ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            // Em caso de erro, registre no log e exiba uma mensagem de erro
            throw new Exception("Erro ao excluir o filme: " . $e->getMessage());
        }
    }
    
}
