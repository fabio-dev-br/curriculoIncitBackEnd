<?php

namespace IntecPhp\Controller;


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
            $data = $this->contact->parseData($params['name'], $params['email'], $params['identity'], $params['user_type'], $params['password']);
            $this->access->newAccount(json_encode($data, true));
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }
}