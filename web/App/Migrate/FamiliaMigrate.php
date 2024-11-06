<?php

namespace App\Migrate;


use App\Models\Model;
use PDOException;

class FamiliaMigrate extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Método para criar a tabela 'Contato'
    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Familia (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    dataSolicitacao DATE,
                    dataPrimeiraVisita DATE,
                    dataAdmissao DATE,
                    dataAfastamento DATE,
                    
                    nome VARCHAR(100) NOT NULL,
                    endereco VARCHAR(255),
                    bairro VARCHAR(100),
                    fone VARCHAR(20),
                    ponto_referencia VARCHAR(255),
                    cpf VARCHAR(14),
                    rg VARCHAR(20),
                    estadoCivil ENUM('Solteiro', 'Casado', 'Divorciado', 'Viúvo', 'Separado') DEFAULT 'Solteiro',
                    dataNascimento DATE,
                    profissao VARCHAR(100),

                    nomeConjuge VARCHAR(100),
                    dataNascimentoConjuge DATE,
                    profissaoConjuge VARCHAR(100),
                    foneConjuge VARCHAR(20),
                    observacoesConjuge TEXT
                );";
        $this->db->exec($sql);
        echo "Tabela 'Familia' criada com sucesso!\n";
    }

    // Método que executa a migração completa
    public function migrate()
    {
        $this->createTable();
    }
}

/*

dataSolicitacao
dataPrimeiraVisita
dataAdmissao
dataAfastamento

nome
endereco
bairro
fone
ponto referencia
cpf
Rg
EstadoCivil
dataNascimento
Profissao


nomeConjuge
dataNascimentoConjuge
profissaoConjuge
foneConjuge
observacoesConjuge





*/