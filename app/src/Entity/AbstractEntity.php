<?php

namespace IntecPhp\Entity;

abstract class AbstractEntity
{

    private $con;

    public function __construct(DbHandler $con)
    {
        $this->con = $con;
    }
}