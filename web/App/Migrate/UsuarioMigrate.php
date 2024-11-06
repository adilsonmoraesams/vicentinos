<?php

namespace App\Migrate;


use App\Models\Model;
use PDOException;

class UsuarioMigrate extends Model
{ 
    public function __construct()
    {
        parent::__construct(); 
    }

    // Método para criar a tabela 'Categoria'
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS usuario (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    nome VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    senha VARCHAR(255) NOT NULL,
                    situacao INT NOT NULL DEFAULT 1 COMMENT '1 - Ativo, 2 - Desativado'
                );";
        $this->db->exec($sql);
        echo "Tabela 'Usuario' criada com sucesso! \r \n ";
    }

    // Método para inserir dados iniciais
    public function insertInitialData()
    {
        try {
            // Verificar se a tabela já possui registros
            $stmt = $this->db->query("SELECT COUNT(*) as count FROM usuario");
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($result['count'] == 0) {
                $sql = "INSERT INTO usuario (id, nome, email, senha, situacao) VALUES 
                        (1, 'Adilson', 'adilsonmoraes.ams@gmail.com', '".md5( SECRET_KEY . "@Dilms146")."', 1)";
                $this->db->exec($sql);
                echo "Dados iniciais inseridos com sucesso!\n";
            } else {
                echo "Tabela 'Usuário' já possui dados. Nenhuma inserção realizada.\n";
            }
        } catch (PDOException $e) {
            echo "Erro ao inserir dados iniciais: " . $e->getMessage() . "\n";
        }
    }

    // Método que executa a migração completa
    public function migrate()
    {
        $this->createTable();
        $this->insertInitialData();
    }
}