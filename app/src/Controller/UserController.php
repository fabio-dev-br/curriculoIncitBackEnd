<?php

namespace IntecPhp\Controller;

use Pheanstalk\Pheanstalk;
use IntecPhp\Model\Contact;
use IntecPhp\Model\ResponseHandler;
use Exception;

//  Classe UserController é um Controller responsável por tratar do cadastro de um novo usuário, o login, a recuperação de senha 
//  , adição/remoção de currículo do usuário comum, atualização do arquivo do currículo do usuário comum, adcionar/remover interesses da empresa, está diretamente ligado com as classes model Access e System 
class UserController
{
    private $access;

    public function __construct($access)
    {
        $this->access = $access;
    }

    // Função na Controller para criar uma nova conta
    public function newAccount($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->access->newAccount($params['name'], $params['email'], $params['identity'], $params['user_type'], $params['password']);
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para logar na plataforma
    public function login($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->access->login($params['email'], $params['password']);
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // 1ª Função na Controller para recuperar a senha (Responsável por tratar a inserção na tabela request_password, ou seja, a parte que
    // enviará o e-mail ao usuário)
    public function forgetMyPass($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->access->forgetMyPass($params['email']);
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // 2ª Função na Controller para recuperar a senha (Responsável por comparar a hash proveniente do email com as entradas 
    // da tabela request_password e trocar a senha em caso de sucesso na etapa anterior)
    public function changeMyPass($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->access->changeMyPass($params['hash'], $params['email'], $params['newPass']);
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }
}
