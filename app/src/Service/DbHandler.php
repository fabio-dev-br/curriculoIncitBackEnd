<?php

namespace IntecPhp\Service;

use PDO;
use PDOException;

/**
 * Faz a manipulação do banco de dados da aplicação
 *
 * @author intec
 */

class DbHandler
{
    private $conn;
    // Construtor privado: só a própria classe pode invocá-lo
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
    public function beginTransaction()
    {
        return $this->conn->beginTransaction();
    }
    public function commit()
    {
        return $this->conn->commit();
    }
    public function query($queryString, $params = [])
    {
        try {
            $sth = $this->conn->prepare($queryString);
            $sth->execute($params);
            return $sth;
        } catch(PDOException $e) {
            if($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log($e->getMessage());
        }
    }
    public function prepare($queryString, array $params)
    {
        try {
            $sth = $this->conn->prepare($queryString);
            $sth->execute($params);
            return $sth;
        } catch(PDOException $e) {
            if($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            error_log($e->getMessage());
        }
    }
    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }
}