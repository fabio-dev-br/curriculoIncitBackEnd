<?php

namespace IntecPhp\Model;

use IntecPhp\Service\JwtWrapper;
use Exception;

class Account
{
    private $jwt;

    public function __construct(JwtWrapper $jwt)
    {
        $this->jwt = $jwt;
    }

    public function encode(array $info)
    {
        return $this->jwt->encode($info);
    }

    public function get(?string $token, string $key = null)
    {
        if(!$token) {
            return false;
        }

        try {
            $data = $this->jwt->decode($token)->data;
            if(is_null($key)) {
                return $data;
            }
            return property_exists($data, $key) ? $data->$key : false;
        } catch (Exception $e) {
            return false;
        }
    }

    // Função responsável por pegar o token enviado no header AUTHORIZATION,
    // a autenticação é do tipo Bearer ( Authorization: Bearer <token> )
    public function getToken() 
    {
        // check if the header HTTP_AUTHORIZATION was sent to server
        // returns the token ex: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9 or void
        if(isset($_SERVER["HTTP_AUTHORIZATION"])){
            $tokenAux = explode(" ", $_SERVER["HTTP_AUTHORIZATION"]);
            return $tokenAux[1];   
            }     
    }
}