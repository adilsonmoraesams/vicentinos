<?php

namespace App\Models;

use PDO;
use PDOException;

class ContatoModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Create
    public function insert($email, $assunto, $comentario)
    {
        try {
            $sql = "INSERT INTO contato (email, assunto, comentario, dataCadastro) 
                VALUES (:email, :assunto, :comentario, NOW())";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':comentario', $comentario);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            exit;
        }
    }

    // Read all
    public function getAll($limit = 10, $offset = 0)
    {
        // Adiciona a cláusula LIMIT e OFFSET para a paginação
        $sql = "SELECT * FROM contato LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID
    public function getById($id)
    {
        $sql = "SELECT * FROM contato
        WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function getTotal()
    {
        $sql = "SELECT COUNT(*) as total FROM contato WHERE 1 = 1 ";

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Update
    public function update($id, $titulo, $idcategoria, $embedVideo, $imagemCapa, $dataPublicacao, $imagemDemo,  $ano, $pais, $sinopse)
    {
        $sql = "UPDATE contato SET titulo = :titulo, idcategoria = :idcategoria, embedVideo = :embedVideo, 
                imagemCapa = :imagemCapa, dataPublicacao = :dataPublicacao, imagemDemo = :imagemDemo, ano= :ano, pais = :pais, sinopse = :sinopse WHERE id = :id";

        try {
            echo $imagemCapa;
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':idcategoria', $idcategoria);
            $stmt->bindParam(':embedVideo', $embedVideo);
            $stmt->bindParam(':imagemCapa', $imagemCapa);
            $stmt->bindParam(':dataPublicacao', $dataPublicacao);
            $stmt->bindParam(':imagemDemo', $imagemDemo);
            $stmt->bindParam(':ano', $ano);
            $stmt->bindParam(':pais', $pais);
            $stmt->bindParam(':sinopse', $sinopse);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            exit;
        }
    }

    // Delete
    public function delete($id)
    {
        $sql = "DELETE FROM contato WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
