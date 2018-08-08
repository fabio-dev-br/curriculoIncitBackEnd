<?php


namespace IntecPhp\Model;

class ResponseHandler
{
    private $code;
    private $message;
    private $data;

    public function __construct($code, $message = '', array $responseData = [])
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $responseData;
    }


    public function format()
    {
        http_response_code($this->code);

        $formattedResponse = [
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ];

        return $formattedResponse;
    }

    public function toJson()
    {
        return json_encode($this->format());
    }

    public function printJson()
    {
        header('Content-Type: application/json');
        echo $this->toJson();
        return $this;
    }
}
