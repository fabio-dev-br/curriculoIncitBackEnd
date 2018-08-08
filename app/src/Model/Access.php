<?php

namespace IntecPhp\Model;

use IntecPhp\Entity\User;
use Exception;

class Access
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function newAccount(array $info)
    {
        
    }
}
