<?php

namespace IntecPhp\Entity;

use IntecPhp\Service\DbHandler;

abstract class AbstractEntity
{

    private $con;

    public function __construct(DbHandler $con)
    {
        $this->con = $con;
    }
}