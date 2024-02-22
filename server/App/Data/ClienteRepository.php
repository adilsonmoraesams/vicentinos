<?php


namespace App\Data;

use App\Models\Cliente;
use Exception;
use PDO;
use PDOException;
use System\Database;
use System\Logs;

class ClienteRepository
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
    public function getClientes()
    {
        try {

            $stmt = $this->conn->query('SELECT * FROM Cliente');

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao listar editar cliente:' . $e->getMessage());
        }
    }

    /* 
    * Listar todos
    */
    public function getByIdClientes($id)
    {
        try {

            $stmt = $this->conn->prepare(' SELECT * FROM Cliente WHERE Id = :Id ');
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
    * Inclusão de cliente
    */
    public function InsertCliente(Cliente $cliente)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'INSERT INTO Cliente (Nome, DataNascimento) VALUES (:Nome, :DataNascimento)'
            );

            $stmt->bindValue(':Nome', $cliente->Nome);
            $stmt->bindValue(':DataNascimento', $cliente->DataNascimento);
            $stmt->execute();

            $this->conn->commit();

            return $this->getByIdClientes($this->conn->lastInsertId());
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao incluir editar cliente:' . $e->getMessage());
        }
    }


    /* 
    * Editar de cliente
    */
    public function EditarCliente(Cliente $cliente, $id)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'UPDATE  Cliente SET 
                    Nome = :Nome, 
                    DataNascimento = :DataNascimento
                WHERE
                    Id = :Id '
            );

            $stmt->bindValue(':Id', $id);
            $stmt->bindValue(':Nome', $cliente->Nome);
            $stmt->bindValue(':DataNascimento', $cliente->DataNascimento);
            $stmt->execute();

            $this->conn->commit();

            return $this->getByIdClientes($id);
        } catch (Exception $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao tentar editar cliente:' . $e->getMessage());
        }
    }


    /* 
    * Inclusão de cliente
    */
    public function ExcluirCliente(Cliente $cliente)
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                'DELETE FROM Cliente WHERE Id = :Id '
            );
            $stmt->bindParam(':Id', $cliente->Id);
            $stmt->execute();

            $this->conn->commit();
        } catch (PDOException $e) {
            Logs::Registrar($e->getMessage());
            throw new Exception('Erro ao tentar excluído cliente:' . $e->getMessage());
        }
    }
 

}
