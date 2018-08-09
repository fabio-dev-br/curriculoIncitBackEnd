<?php

namespace IntecPhp\Controller;

use Pheanstalk\Pheanstalk;
use IntecPhp\Model\Contact;
use IntecPhp\Model\ResponseHandler;
use Exception;

//  Classe UserController é um Controller responsável por tratar do cadastro de um novo usuário, o login e a recuperação de senha
//  está diretamente ligado com a classe model Access
class UserController
{
    private $access;

    public function __construct($access)
    {
        $this->access = $access;
    }

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
}