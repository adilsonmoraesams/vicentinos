<?php

use System\Logs;

namespace System;

use ArrayObject;
use Exception;
use LogicException;
use PDO;
use PDOException;
use RuntimeException;

class Database
{
    //Dados de acesso
    private static $pdo;
    private $host = "localhost";
    private $db  = "vicentinos";
    private $user = "root";
    private $pass = "12345678";

    private static $instance; 

    function __construct()
    {
        try {
            //Conectar
            // $pdo = new PDO("mysql:dbname=$this->db; host=$this->host", $this->user, $this->pass);

            self::$pdo = new PDO('sqlite:banco.sqlite'); 
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Logs::Registrar($e->getMessage());
        }
    }

    // public function Insert($stmt){
    //     try {
    //         self::$pdo->beginTransaction();
           
    //         $stmt->execute();

    //         self::$pdo->commit();
            
    //     } catch (Exception $e) {
    //         self::$pdo->rollback();
    //     }
    // }



    // public function get($key)
    // { 
    //     if ($this->storage->offsetExists($key)) {
    //         return $this->storage->offsetGet($key);
    //     } else {
    //         throw new RuntimeException(sprintf('Não existe um registro para a chave "%s".', $key));
    //     }
    // }

    public function getInstance()
    {
        // if (!self::$instance)
        //     self::$instance = new Database();

        return self::$pdo;
    }

    // public function set($key, $value)
    // {
    //     if (!$this->storage->offsetExists($key)) {
    //         $this->storage->offsetSet($key, $value);
    //     } else {
    //         throw new LogicException(sprintf('Já existe um registro para a chave "%s".', $key));
    //     }
    // }

    // public function unregister($key)
    // {
    //     if ($this->storage->offsetExists($key)) {
    //         $this->storage->offsetUnset($key);
    //     } else {
    //         throw new RuntimeException(sprintf('Não existe um registro para a chave "%s".', $key));
    //     }
    // }
    /*

    public function Insert($tabela, $array = array())
    {

        $collums = implode(",",  array_keys($array));
        $values = implode(array_keys($array),);

        $novo_cliente = array(
            'nome' => 'José',
            'departamento' => 'TI',
            'unidade' => 'Paulista'
        );

        $banco->prepare('INSERT INTO clientes (nome,departamento,unidade) VALUES (:nome,:departamento,:unidade)')->execute($novo_cliente);


        echo $sql = "INSERT INTO {$tabela} ({$collums}) VALUES ({$values})";
        exit;
        // $banco->prepare('')->execute($novo_cliente);

    }
    */
}
