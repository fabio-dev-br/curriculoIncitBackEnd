<?php

namespace IntecPhp\Model;

use IntecPhp\Entity\User;
use IntecPhp\Entity\RequestPassword;
use Exception;

//  Classe Acess é um Model responsável por tratar do cadastro de um novo usuário, o login e a recuperação de senha
//  está diretamente ligado com as entidades User e RequestPassword
class Access
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    // Função para criar uma nova conta de usuário
    public function newAccount($name, $email, $identity, $user_type, $password)
    {
        // Verifica se já existe o usuário na tabela, em caso de sucesso retorna o usuário em user2, caso contrário, retorna false
        if($this->user->getUser($email)) {
            throw new Exception('Existe um usuario com esse e-mail');
        }
        // Insere o usuário na tabela, em caso de sucesso retorna o usuário em user2, caso contrário, retorna false
        $user2 = $this->user->insert($name, $email, $identity, $user_type, $password);
        if($user2) {
            throw new Exception('A insercao nao foi feita com sucesso');
        }
    }

    //Função para fazer o login do usuário
    public function login($name)
    {

    }
}
