<?php

namespace IntecPhp\Entity;

use IntecPhp\Service\DbHandler;
use Exception;

// Entidade ResquestPassword é responsável por lidar com a tabela request_password
class RequestPassword extends AbstractEntity
{
    // Variáveis herdadas da classe pai e sobrescritas para permitir a utilização correta das funções da classe abstrata 
    // Nome da tabela
    protected $name = 'request_password';
    // Id
    protected $id = 'id';

    // Função que adiciona uma entrada à tabela request_password, em caso de sucesso retorna o ID do novo request, caso contrário, retorna false
    public function insert($userId, $hash, $expDate)
    {
        // Caso o email exista na base de usuário (ou seja, existe algum valor em userID), a inserção na tabela request_password é feita
        // em caso contrário, retorna false
        if($userId){
            $stm = $this->conn->query("insert into request_password (id_user, hash, exp_date) values (?, ?, ?)", [
                $userId, 
                $hash, 
                $expDate
            ]);
            
            // Caso a query tenha ocorrido perfeitamente o id do request inserido é retornado à classe Access
            if($stm) {
                return $this->conn->lastInsertId();
            }

        } 
        return false;
    }
}
