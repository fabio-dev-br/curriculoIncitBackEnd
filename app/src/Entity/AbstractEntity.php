<?php
namespace IntecPhp\Entity;
use IntecPhp\Service\DbHandler;

// Classe abstrata de todas as entidades
abstract class AbstractEntity
{
    // Variável para manipulação do banco de dados
    protected $conn;
    
    // Variáveis sobrescritas nas classes filhas para utilização da função get e getAll
    protected $name;
    protected $id;

    public function __construct(DbHandler $conn)
    {
        $this->conn = $conn;
    }

    public function get($id)
    {
        $stmt = $this->conn->query(
            "select * from $this->name where $this->id = ?",
            [$id]
        );
        if($stmt && $abs = $stmt->fetch()){
            return $abs;
        }
        return false;
    }

    public function getAll()
    {
        $stmt = $this->conn->query(
            "select * from $this->name ",
            []
        );
        if($stmt){
            return $stmt->fetchAll();
        }
        return false;
    }

}