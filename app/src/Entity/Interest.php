<?php

namespace IntecPhp\Entity;

// Entidade Interest é responsável por lidar com a tabela interest
class Interest extends AbstractEntity
{
    // Variáveis herdadas da classe pai e sobrescritas para permitir a utilização correta das funções da classe abstrata 
    // Nome da tabela
    protected $name = 'interest';
    
    // Id
    protected $id = 'id';

    // Função que insere o interesse na tabela, em caso de sucesso retorna o ID do interesse novo, caso contrário, retorna false
    public function insert($interest, $userId)
    {
        $stm = $this->conn->query("insert into interest (interest, id_user) 
            values (?, ?)", [
                $interest, 
                $userId
            ]
        );
        
        // Caso a query tenha ocorrido perfeitamente o ID do interesse inserido é retornado à classe System
        if($stm) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Função que deleta o interesse na tabela retorna true, em caso de sucesso
    public function delete($interest, $userId)
    {
        $stm = $this->conn->query("delete from interest where interest = ? and id_user = ?", [
                $interest, 
                $userId
            ]
        );
        
        // Caso a query tenha ocorrido perfeitamente retorna true
        if($stm) {
            return true;
        }
        return false;
    }
}