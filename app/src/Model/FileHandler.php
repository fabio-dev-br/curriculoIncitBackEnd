<?php


namespace IntecPhp\Model;

class FileHandler
{
    private $path;    

    public function __construct($path)
    {
        $this->path = $path;
    }


    public function moveFile($tmpFileName)
    {
        
        
        $fileHash = md5(uniqid($tmpFileName));
        // Retorna o hash gerado a partir do nome temporário do arquivo
        return $fileHash;
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
