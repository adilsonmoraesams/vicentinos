<?php

namespace App\Migrate;


use App\Models\Model;
use PDOException;

class MembrosMigrate extends Model
{ 
    public function __construct()
    {
        parent::__construct(); 
    }

    // Método para criar a tabela 'Categoria'
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS membros (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    nome VARCHAR(255) NOT NULL,
                    dataNascimento datetime,
                    situacao INT NOT NULL COMMENT '1 - Apoio, 2 - Aspirante, 3 - Confrade/Consórcia'
                );";
        $this->db->exec($sql);
        echo "Tabela 'Membros' criada com sucesso!\n";
    }

    // Método para inserir dados iniciais
    /*public function insertInitialData()
    {
        try {
            // Verificar se a tabela já possui registros
            $stmt = $this->db->query("SELECT COUNT(*) as count FROM categoria");
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                $sql = "INSERT INTO categoria (id, descricao) VALUES 
                        (1, 'Soft'),
                        (2, 'Hard')";
                $this->db->exec($sql);
                echo "Dados iniciais inseridos com sucesso!\n";
            } else {
                echo "Tabela 'Categoria' já possui dados. Nenhuma inserção realizada.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao inserir dados iniciais: " . $e->getMessage() . "\n";
        }
    }*/

    // Método que executa a migração completa
    public function migrate()
    {
        $this->createTable();
        // $this->insertInitialData();
    }
}