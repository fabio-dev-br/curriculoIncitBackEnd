<?php

namespace IntecPhp\Controller;

use Pheanstalk\Pheanstalk;
use IntecPhp\Model\Contact;
use IntecPhp\Model\ResponseHandler;
use Exception;

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
            
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }
}