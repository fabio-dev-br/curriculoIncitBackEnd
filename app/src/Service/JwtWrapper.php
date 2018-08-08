<?php

namespace IntecPhp\Service;

use Firebase\JWT\JWT;

class JwtWrapper
{
    private $secret;
    private $duration;

    public function __construct(string $secret, int $duration)
    {
        $this->secret = $secret;
        $this->duration = $duration;
    }

    public function encode(array $info)
    {
        $issuedAt = time();
        $expires = $issuedAt + $this->duration;

        $tokenParams = [
            'iat'  => $issuedAt,
            'exp'  => $expires,
            'nbf'  => $issuedAt - 1,
            'data' => $info,
        ];

        return JWT::encode($tokenParams, $this->secret);
    }

    public function decode(string $jwtToken)
    {
        return JWT::decode($jwtToken, $this->secret, ['HS256']);
    }
}
