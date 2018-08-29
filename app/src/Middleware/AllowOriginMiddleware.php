<?php
namespace IntecPhp\Middleware;

// Middleware para permitir que os recursos da resposta possam ser
// ser compartilhados com a origem dada
class AllowOriginMiddleware
{
    public function process()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}