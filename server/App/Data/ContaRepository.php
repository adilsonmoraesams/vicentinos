<?php

namespace App\Data;

use Conta;
use Exception;
use PDO;
use PDOException;
use System\Database;
use System\Logs;

class ContaRepository
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getInstance();
    }


    /* 
    * Listar todos
    */
    public function getContas()
    {
        try {

            $stmt = $this->conn->query('SELECT * FROM Conta');

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao listar editar cliente:' . $e->getMessage());
        }
    }

    /* 
    * Listar todos
    */
    public function getByIdContasgetContas($id)
    {
        try {

            $stmt = $this->conn->prepare(' SELECT * FROM Conta WHERE Id = :Id ');
            $stmt->bindValue(':Id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            // return $this->toObject($result);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao consultar editar cliente:' . $e->getMessage());
        }
    }


    /* 
    * Inclusão de ContasgetContas
    */
    public function InsertConta(Conta $Conta)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'INSERT INTO 
                    Conta (idTipoConta, descricao, valor, situacao, dataVencimento, dataPagamento, dataFechamento, ) 
                VALUES 
                    (:idTipoConta, :descricao, :valor, :situacao, :dataVencimento, :dataPagamento, :dataFechamento, :comprovante)'
            );

            $stmt->bindValue(':idTipoConta', $Conta->idTipoConta);
            $stmt->bindValue(':descricao', $Conta->descricao);
            $stmt->bindValue(':valor', $Conta->valor);
            $stmt->bindValue(':situacao', $Conta->situacao);
            $stmt->bindValue(':dataVencimento', $Conta->dataVencimento);
            $stmt->bindValue(':dataPagamento', $Conta->dataPagamento);
            $stmt->bindValue(':dataFechamento', $Conta->dataFechamento);
            $stmt->bindValue(':comprovante', $Conta->comprovante);
                   
            $stmt->execute();

            $this->conn->commit();

            return $this->getByIdContasgetContas($this->conn->lastInsertId());
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao incluir editar conta$Conta:' . $e->getMessage());
        }
    }


    /* 
    * Editar de conta$Conta
    */
    public function EditarConta(Conta $Conta, $id)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'UPDATE  Conta SET 
                    idTipoConta = :idTipoConta, 
                    DataNascimento = :DataNascimento
                WHERE
                    Id = :Id '
            );

            $stmt->bindValue(':idTipoConta', $Conta->idTipoConta);
            $stmt->bindValue(':descricao', $Conta->descricao);
            $stmt->bindValue(':valor', $Conta->valor);
            $stmt->bindValue(':situacao', $Conta->situacao);
            $stmt->bindValue(':dataVencimento', $Conta->dataVencimento);
            $stmt->bindValue(':dataPagamento', $Conta->dataPagamento);
            $stmt->bindValue(':dataFechamento', $Conta->dataFechamento);
            $stmt->bindValue(':comprovante', $Conta->comprovante);
            $stmt->execute();

            $this->conn->commit();

            return $this->getByIdContasgetContas($id);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao tentar editar conta$Conta:' . $e->getMessage());
        }
    }


    /* 
    * Inclusão de conta$Conta
    */
    public function ExcluirConta(Conta $Conta)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'DELETE FROM Conta WHERE Id = :Id '
            );
            $stmt->bindParam(':Id', $Conta->id);
            $stmt->execute();

            $this->conn->commit();
        } catch (PDOException $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao tentar excluído conta$Conta:' . $e->getMessage());
        }
    }
 

}