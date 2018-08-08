<?php

namespace IntecPhp\Model;

use IntecPhp\Service\JwtWrapper;
use IntecPhp\Service\Cookie;
use Exception;

class Account
{
    private $jwt;
    private $sessionCookie;

    public function __construct(JwtWrapper $jwt, Cookie $sessionCookie)
    {
        $this->jwt = $jwt;
        $this->sessionCookie = $sessionCookie;
    }

    public function login(array $info)
    {
        $token = $this->jwt->encode($info);
        return [
            'name' => $this->sessionCookie->getName(),
            'value' => $this->sessionCookie->set($token)
        ];
    }

    public function isLoggedIn()
    {
        try {
            $token = $this->sessionCookie->get();
            if (!$token) {
                throw new Exception('Usuário não logado');
            }
            return $this->jwt->decode($token);
        } catch (Exception $e) {
        }

        return false;
    }

    public function logout()
    {
        $this->sessionCookie->remove();
    }
}
