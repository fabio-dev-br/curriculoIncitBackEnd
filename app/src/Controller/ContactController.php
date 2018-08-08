<?php

namespace IntecPhp\Controller;

use Pheanstalk\Pheanstalk;
use IntecPhp\Model\Contact;
use IntecPhp\Model\ResponseHandler;
use Exception;

class ContactController
{
    private $contact;
    private $emailProducer;

    public function __construct(Contact $contact, Pheanstalk $emailProducer)
    {
        $this->contact = $contact;
        $this->emailProducer = $emailProducer;
    }

    public function contact($request)
    {
        $params = $request->getPostParams();

        try {
            $data = $this->contact->parseData($params['name'], $params['email'], $params['message']);
            $this->emailProducer->put(json_encode($data, true));
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }
}
