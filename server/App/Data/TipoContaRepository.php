<?php

namespace App\Data;
 
use Exception;
use PDO;
use PDOException;
use System\Database;
use System\Logs;
use TipoConta;

class TipoContaRepository
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
    public function getTipoContas()
    {
        try {

            $stmt = $this->conn->query('SELECT * FROM TipoConta');

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao listar editar cliente:' . $e->getMessage());
        }
    }

    /* 
    * Listar todos
    public function getByIdTipoContas($id)
    {
        try {

            $stmt = $this->conn->prepare(' SELECT * FROM TipoConta WHERE Id = :Id ');
            $stmt->bindValue(':Id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            // return $this->toObject($result);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao consultar editar cliente:' . $e->getMessage());
        }
    }
    */


    /* 
    * Inclusão de TipoContas
    public function InsertTipoConta(TipoConta $TipoConta)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'INSERT INTO TipoConta (Nome, DataNascimento) VALUES (:Nome, :DataNascimento)'
            );

            $stmt->bindValue(':Nome', $TipoConta->Nome);
            $stmt->bindValue(':DataNascimento', $TipoConta->DataNascimento);
            $stmt->execute();

            $this->conn->commit();

            return $this->getByIdTipoContas($this->conn->lastInsertId());
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao incluir editar tipoconta$TipoConta:' . $e->getMessage());
        }
    }
    */


    /* 
    * Editar de tipoconta$TipoConta
    public function EditarTipoConta(TipoConta $TipoConta, $id)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'UPDATE  TipoConta SET 
                    Nome = :Nome, 
                    DataNascimento = :DataNascimento
                WHERE
                    Id = :Id '
            );

            $stmt->bindValue(':Id', $id);
            $stmt->bindValue(':Nome', $TipoConta->Nome);
            $stmt->bindValue(':DataNascimento', $TipoConta->DataNascimento);
            $stmt->execute();

            $this->conn->commit();

            return $this->getByIdTipoContas($id);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao tentar editar tipoconta$TipoConta:' . $e->getMessage());
        }
    }
    */


    /* 
    * Inclusão de tipoconta$TipoConta
    public function ExcluirTipoConta(TipoConta $TipoConta)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'DELETE FROM TipoConta WHERE Id = :Id '
            );
            $stmt->bindParam(':Id', $TipoConta->Id);
            $stmt->execute();

            $this->conn->commit();
        } catch (PDOException $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao tentar excluído tipoconta$TipoConta:' . $e->getMessage());
        }
    }
    */
 

}