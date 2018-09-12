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

    // Função que recupera a entrada na tabela request_password, em caso de sucesso retorna o ID do request, caso contrário, retorna false
    public function getRequest($userId)
    {
        if($userId) {
            $stm = $this->conn->query("select id from request_password where id_user = ?", [
                $userId
            ]);
            
            $id = $stm->fetch();
            $id = $id['id'];
            // Caso a query tenha ocorrido perfeitamente o id do request é retornado à classe Access
            if($id) {                
                return $id;
            }
        } 
        return false;
    }

    // Função que atualiza o registro na tabela request_password
    public function updateRequest($id, $hash, $expDate)
    {
        $stm = $this->conn->query("update request_password set hash = ?, exp_date = ? where id = ?", [
            $hash,
            $expDate,
            $id
        ]);
    }

    // Função que adiciona uma entrada à tabela request_password, em caso de sucesso 
    // retorna o ID do novo request, caso contrário, retorna false
    public function insert($userId, $hash, $expDate)
    {
        // Caso o email exista na base de usuário (ou seja, existe algum valor em userID), 
        // a inserção na tabela request_password é feita em caso contrário, retorna false
        if($userId) {
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

    // Função que compara a data atual com a valor presente no request_password, em caso de sucesso 
    // retorna true
    public function compareDate($userId, $currentDate)
    {
        $stm = $this->conn->query("select exp_date from request_password where id_user = ?", [
            $userId
        ]);
        $expDate = $stm->fetch();
        $expDate = $expDate['exp_date'];
        if((strtotime($expDate)-strtotime($currentDate)) >= 0) {
            return true;
        }
        return false;
    }

    // Função que compara ID do usuário, hash com os valores presentes no request_password, em caso de sucesso 
    // retorna o ID do request, caso contrário, retorna false
    public function compare($userId, $hash)
    {
        // Caso o email exista na base de usuário (ou seja, existe algum valor em userID), a inserção na tabela request_password é feita
        // em caso contrário, retorna false
        if($userId) {
            $stm = $this->conn->query("select * from request_password where id_user = ? and hash = ?", [
                $userId, 
                $hash
            ]);
            $id = $stm->fetch();
            $id = $id['id'];

            // Caso a query tenha ocorrido perfeitamente o id do request é retornado à classe Access
            if($id) {
                return $id;
            }
        } 
        return false;
    }
}
