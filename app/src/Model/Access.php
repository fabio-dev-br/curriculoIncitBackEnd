<?php

namespace IntecPhp\Model;

use IntecPhp\Entity\User;
use IntecPhp\Entity\RequestPassword;
use Exception;

//  Classe Access é um Model responsável por tratar do cadastro de um novo usuário, o login e a recuperação de senha
//  está diretamente ligado com as entidades User e RequestPassword
class Access
{
    private $user;
    private $requestPass;

    public function __construct(User $user, RequestPassword $requestPass)
    {
        $this->user = $user;
        $this->requestPass = $requestPass;
    }

    // Função na Model para criar uma nova conta de usuário
    public function newAccount($name, $email, $identity, $user_type, $password)
    {
        // Verifica se já existe o usuário na tabela, em caso de sucesso uma exceção é lançada
        if($this->user->getUser($email)) {
            throw new Exception('Existe um usuário com esse e-mail');
        }
        // Insere o usuário na tabela, em caso de sucesso retorna o id do novo usuário, caso contrário, uma exceção é lançada
        $idUser = $this->user->insert($name, $email, $identity, $user_type, $password);
        if(!$idUser) {
            throw new Exception('Não foi possivel fazer o cadastro do usuário');
        }
    }

    // Função na Model para fazer o login do usuário
    public function login($email, $password)
    {
        // Verifica se o email existe, em caso de sucesso retorna o id do usuário, caso contrário, uma exceção é lançada 
        $idUser = $this->user->getUser($email);
        if(!$idUser) {
            throw new Exception('Não existe um usuário com esse e-mail');
        }
        // Verifica se o usuário e a senha coincidem, em caso de sucesso retorna true, caso contrário, uma exceção é lançada
        if(!$this->user->login($email, $password)) {
            throw new Exception('Senha incorreta. Tente novamente ou clique em esqueci a senha');
        }
    }

    // Função na Model para recuperar a senha
    public function forgetMyPass($email)
    {
        // Verifica se o email existe, em caso de sucesso retorna o id do usuário, caso contrário, nada acontece por
        // questão de segurança
        $idUser = $this->user->getUser($email);
        // Gera um hash para a requisição de uma nova senha
        $hash = md5(uniqid(""));
        var_dump($hash);
        // Obtenção do dia e hora atual / referência: São Paulo
        date_default_timezone_set('America/Sao_Paulo');
        //$date = date('Y-m-d h:i:s');
        // Um intervalo de 1 dia é adicionado ao tempo atual
            // mktime - obtém um timestamp Unix do dia atual
        $expDate  = mktime (date("h"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
            // Converte o timestamp para o formato de data Y-m-d h:i:s
        $expDate = date('Y-m-d h:i:s', $expDate);
        var_dump($expDate);
        // Chama a função da entidade RequestPassword para adicionar um registro na tabela request_password
        var_dump($this->requestPass->insert($idUser, $hash, $expDate));
        die("forget id request");
        if(!$this->requestPass->insert($idUser, $hash, $expDate)) {
            throw new Exception('A requisição não ocorreu adequadamente');
        }
        
    }
}
