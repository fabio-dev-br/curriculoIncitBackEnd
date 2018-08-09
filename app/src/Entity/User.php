<?php

namespace IntecPhp\Entity;

use IntecPhp\Service\DbHandler;
use Exception;

class User extends AbstractEntity
{
    // Variáveis herdadas da classe pai e sobrescritas para permitir a utilização correta das funções da classe abstrata 
    // Nome da tabela
    protected $name = 'user';
    // Id
    protected $id = 'id';

    // Função que verifica se o usuário existe na tabela, em caso de sucesso retorna o usuário, caso contrário, retorna false
    public function getUser($email)
    {
        $stm = $this->conn->query("select * from user where email = ?", [$email]);
        if($stm) {
            $user =  $stm->fetch();
            if($user) {
                return $user;
            }
        }

        return false;
    }

    // Função que insere o usuário na tabela, em caso de sucesso retorna o usuário em user2, caso contrário, retorna false
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
        
        if($stm) {
            return $this->conn->insertId();
        }

        throw new Exception('Não foi possivel fazer o cadastro do usuário');
    }
}
