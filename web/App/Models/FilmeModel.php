<?php

namespace App\Models;

use PDO;
use PDOException;

class FilmeModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Create
    public function createFilme($titulo, $idcategoria, $embedVideo, $imagemCapa, $dataPublicacao, $imagemDemo, $ano, $pais, $sinopse)
    {
        try {
            $sql = "INSERT INTO filmes (titulo, idcategoria, embedVideo, imagemCapa, dataPublicacao, imagemDemo, ano, pais, sinopse) 
                VALUES (:titulo, :idcategoria, :embedVideo, :imagemCapa, :dataPublicacao, :imagemDemo, :ano, :pais, :sinopse)";

            $stmt = $this->db->prepare($sql);
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

    // Read all
    public function getAllFilmes($limit = 10, $offset = 0)
    {
        // Adiciona a cláusula LIMIT e OFFSET para a paginação
        $sql = "SELECT filmes.*, categoria.descricao as categoria FROM filmes
        INNER JOIN categoria on categoria.id = filmes.idcategoria
        LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getSugestaoRandom($limit)
    {
        // Adiciona a cláusula LIMIT e OFFSET para a paginação
        $sql = "SELECT * FROM filmes ORDER BY RAND() LIMIT :limit ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategoriasano()
    {
        $sql = " SELECT DISTINCT ano FROM filmes ORDER BY ano DESC ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategoriaspais()
    {
        $sql = " SELECT DISTINCT pais FROM filmes ORDER BY pais DESC ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getTotalFilmes($ano = null, $pais = null)
    {
        $sql = "SELECT COUNT(*) as total FROM filmes WHERE 1 = 1 ";

        if ($ano)
            $sql .= " AND ano = '" . $ano . "' ";


        if ($pais)
            $sql .= " AND pais = '" . $pais . "' ";

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Read by ID
    public function getFilmeById($id)
    {
        $sql = "SELECT filmes.*, categoria.descricao as categoria FROM filmes
        INNER JOIN categoria on categoria.id = filmes.idcategoria
        WHERE filmes.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFilmeByAno($ano, $limit = 10, $offset = 0)
    {
        $sql = "SELECT filmes.*, categoria.descricao as categoria FROM filmes
        INNER JOIN categoria on categoria.id = filmes.idcategoria WHERE ano like :ano 
        LIMIT :limit OFFSET :offset ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':ano', $ano, \PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getFilmeByPais($pais, $limit = 10, $offset = 0)
    {
        $sql = "SELECT filmes.*, categoria.descricao as categoria FROM filmes
        INNER JOIN categoria on categoria.id = filmes.idcategoria WHERE pais like :pais 
        LIMIT :limit OFFSET :offset ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':pais', $pais, \PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Update
    public function updateFilme($id, $titulo, $idcategoria, $embedVideo, $imagemCapa, $dataPublicacao, $imagemDemo,  $ano, $pais, $sinopse)
    {
        $sql = "UPDATE filmes SET titulo = :titulo, idcategoria = :idcategoria, embedVideo = :embedVideo, 
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
    public function deleteFilme($id)
    {
        $sql = "DELETE FROM filmes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
