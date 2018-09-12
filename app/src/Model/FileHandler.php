<?php

namespace IntecPhp\Model;

use Exception;

class FileHandler
{
    private $path;    

    public function __construct($path)
    {
        $this->path = $path;
    }

    // Função responsável por mover o arquivo proveniente do front-end para a pasta public/curriculos
    public function moveFile($tmpFileName)
    {
        $fileHash = $this->generateFilename();        
        if(move_uploaded_file($tmpFileName, $this->concatPathFileName($fileHash))) {
            // Retorna o hash gerado a partir do nome temporário do arquivo
            return $fileHash;
        }        
        throw new Exception('O upload do arquivo não ocorreu adequadamente');
    }

    // Função para gerar o hash do arquivo a partir das funções sha1 e uniqid
    private function generateFilename()
    {
        return (sha1(uniqid()));        
    }

    // Função para concatenar o nome/hash do arquivo com o caminho 
    // proveniente do path (o qual foi definido em config/settings)
    private function concatPathFileName($fileHash)
    {
        // sprintf -> nesse caso, se ocorreu um sucesso, retorna a string concatenada, caso contrário, retorna falso
        return sprintf('%s%s', $this->path, $fileHash);
    }

}
