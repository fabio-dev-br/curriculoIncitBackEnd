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
        
        // Caso a query tenha ocorrido perfeitamente e o id seja válido, retorna true
        if($stm && $userId) {
            return true;
        }
        return false;
    }

    // Função que retorna os interesses na presentes na tabela interest, em caso de sucesso 
    // retorna interests, caso contrário, retorna false
    public function getInterests($userId)
    {
        $stm = $this->conn->query("select interest from interest where id_user = ?", [
                $userId
            ]
        );
        if($stm) {
            // Variável stms recebe todas as linhas encontradas na tabela interest com o ID de usuário fornecido
            $stms = $stm->fetchAll();

            // Se existe algum valor no stms as interesses são recuperadas, caso contrário retorna false
            if($stms) {
                // O vetor interests receberá todos os interesses da empresa
                foreach ($stms as $interest) {
                    $interests[] = $interest['interest'];
                }

                // Caso haja interesses é retornado o vetor interests, caso contrário, retorna-se false
                if($interests) {
                    return $interests;
                }
            }      
        }
        return false;
    }   
    
    // Função que retorna os ids dos usuários a partir de um interesse dado, em caso de sucesso 
    // retorna usersId, caso contrário, retorna false
    public function getUsersId($interest)
    {
        $stm = $this->conn->query("select distinct id_user from interest where interest = ?", [
                $interest
            ]
        );
        if($stm) {
            // Variável stms recebe todas as linhas encontradas na tabela interest com interesse fornecido
            $stms = $stm->fetchAll();
            $usersId = [];

            // O vetor usersId receberá todos os IDs de usuários
            foreach ($stms as $userId) {
                $usersId[] = $userId['id_user'];
            }

            // Caso haja usuários é retornado o vetor usersId, caso contrário, retorna-se false
            if($usersId) {
                return $usersId;
            }
        }
        return false;
    }  
}