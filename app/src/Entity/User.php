<?php

namespace IntecPhp\Entity;

use IntecPhp\Service\DbHandler;
use Exception;

// Entidade User é responsável por lidar com a tabela user
class User extends AbstractEntity
{
    // Variáveis herdadas da classe pai e sobrescritas para permitir a utilização correta das funções da classe abstrata 
    // Nome da tabela
    protected $name = 'user';
    
    // Id
    protected $id = 'id';

    // Função que verifica se o usuário existe na tabela, em caso de sucesso retorna o id do usuário, caso contrário, retorna false
    public function getUser($email)
    {
        $stm = $this->conn->query("select * from user where email = ?", [$email]);
        if($stm) {
            $user =  $stm->fetch();
            if($user) {
                return $user['id'];
            }
        }

        return false;
    }

    // Função que insere o usuário na tabela, em caso de sucesso retorna o ID do usuário novo, caso contrário, retorna false
    public function insert($name, $email, $identity, $user_type, $password)
    {
        // S.O.L.I.D
        // Single responsibility - Your class must have one and only one reason to change
        $stm = $this->conn->query("insert into user (name, email, identity, user_type, password) values (?, ?, ?, ?, ?)", [
            $name, 
            $email, 
            $identity, 
            $user_type, 
            $password
        ]);
        
        // Caso a query tenha ocorrido perfeitamente o ID do usuário inserido é retornado à classe Access
        if($stm) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    // Função que faz o login do usuário, em caso de sucesso (usuário e senha coincidem) retorna true, caso contrário, retorna false
    public function login($email, $password)
    {
        $stm = $this->conn->query("select user_type, id from user where email = ? and password = ?", [
            $email,  
            $password
        ]);
        // Caso a query tenha ocorrido perfeitamente (e-mail e senha coincidem) o tipo e o id do usuário são retornados à classe Access
        $info = $stm->fetch();
        if($info) {    
            return $info;
        }
        
        return false;
    }

    // Função que atualiza a senha na tabela user
    public function updatePass($userId, $newPass)
    {
        $stm = $this->conn->query("update user set password = ? where id = ?", [
            $newPass,
            $userId
        ]);

        // Caso a query tenha ocorrido perfeitamente retorna true
        if($stm) {
            return true;
        }
        return false;
    }
}
