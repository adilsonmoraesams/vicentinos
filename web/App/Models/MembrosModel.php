<?php

namespace App\Models;

use PDO;
use PDOException;

class MembrosModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Create - adiciona um novo membro
    public function insert($nome, $dataNascimento, $situacao)
    {
        try {
            $sql = "INSERT INTO membros (nome, dataNascimento, situacao) 
                    VALUES (:nome, :dataNascimento, :situacao)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':situacao', $situacao, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            exit;
        }
    }

    // Read all - obtém todos os membros com paginação
    public function getAll($limit = 10, $offset = 0)
    {
        $sql = "SELECT * FROM membros LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID - obtém um membro pelo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM membros WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getTotal()
    {
        $sql = "SELECT COUNT(*) as total FROM membros WHERE 1 = 1 ";
 
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Update - atualiza as informações de um membro
    public function update($id, $nome, $dataNascimento, $situacao)
    {
        $sql = "UPDATE membros SET nome = :nome, dataNascimento = :dataNascimento, situacao = :situacao 
                WHERE id = :id";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':dataNascimento', $dataNascimento);
            $stmt->bindParam(':situacao', $situacao, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            exit;
        }
    }

    // Delete - remove um membro pelo ID
    public function delete($id)
    {
        $sql = "DELETE FROM membros WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}
