<?php

namespace IntecPhp\Controller;

use Pheanstalk\Pheanstalk;
use IntecPhp\Model\Contact;
use IntecPhp\Model\Account;
use IntecPhp\Model\Access;
use IntecPhp\Model\ResponseHandler;
use Exception;

//  Classe UserController é um Controller responsável por tratar do cadastro de um novo usuário, o login, a recuperação de senha,
//  está diretamente ligado com as classes model Access e Account 
class UserController
{
    private $access;
    private $account;

    public function __construct(Access $access, Account $account)
    {
        $this->access = $access;
        $this->account = $account;
    }
    // Função na Controller para verficar se o e-mail já está atrelado 
    // à um usuário
    public function isEmailUnique($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->access->isEmailUnique( 
                $params['email']
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para criar uma nova conta
    public function newAccount($request)
    {
        $params = $request->getPostParams();

        try {
            $this->access->newAccount(
                $params['name'], 
                $params['email'], 
                $params['identity'], 
                $params['user_type'], 
                $params['password']
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para logar na plataforma, a variável result recebe o tipo e o id de usuário e repassa 
    // para o front-end em caso de sucesso
    public function login($request)
    {
        $params = $request->getPostParams();
        
        try {
            $result = $this->access->login(
                $params['email'], 
                $params['password']
            );

            // Criptografa as informações para enviar para o front-end
            $token = $this->account->encode($result);
            
            $rp = new ResponseHandler(200, '', [
                'token' => $token,
                'user_type' => $result['user_type'],
                'nome' => $result['name']
            ]);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // 1ª Função na Controller para recuperar a senha (Responsável por tratar a inserção na tabela request_password, ou seja, a parte que
    // enviará o e-mail ao usuário)
    public function forgotMyPass($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->access->forgotMyPass(
                $params['email']
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // 2ª Função na Controller para recuperar a senha (Responsável por comparar o hash 
    // e o id(key => hash e id do usuário criptografados) provenientes do email com 
    // as entradas da tabela request_password)
    public function verifyHashChangePass($request)
    {
        $params = $request->getQueryParams();

        // Recupera o id do usuário e o hash contidos na key
        $userId = $this->account->get($params['key'], "userId");        
        $hash = $this->account->get($params['key'], "hash");

        try {
            $this->access->verifyHashChangePass(
                $hash,
                $userId
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // 3ª Função na Controller para recuperar a senha (Responsável por trocar a senha em caso de sucesso na etapa anterior)
    public function changeMyPass($request)
    {
        $params = $request->getPostParams();
        
        // Recupera o id do usuário 
        $userId = $this->account->get($params['key'], "userId");
             
        try {
            $this->access->changeMyPass( 
                $params['newPass'],
                $userId
            );            
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }
}
