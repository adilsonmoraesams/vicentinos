<?php

namespace App\Migrate;


use App\Models\Model;

class FilmeMigrate extends Model
{ 
    public function __construct()
    {
        parent::__construct(); 
    }

    // Método para criar a tabela 'Categoria'
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS filmes (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    titulo VARCHAR(255) NOT NULL,
                    idcategoria int,
                    embedVideo TEXT NOT NULL,
                    imagemCapa TEXT NOT NULL,
                    imagemDemo TEXT NULL,
                    ano VARCHAR(4) NULL,
                    pais VARCHAR(100) NULL,
                    dataPublicacao DATE NOT NULL,
                    sinopse TEXT NOT NULL
                );";
        $this->db->exec($sql);
        echo "Tabela 'Filme' criada com sucesso!\n";
    }

    // Método que executa a migração completa
    public function migrate()
    {
        $this->createTable();
    }
}