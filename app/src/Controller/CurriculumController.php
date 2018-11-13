<?php

namespace IntecPhp\Controller;

use Pheanstalk\Pheanstalk;
use IntecPhp\Model\Account;
use IntecPhp\Model\Contact;
use IntecPhp\Model\FileHandler;
use IntecPhp\Model\System;
use IntecPhp\Model\ResponseHandler;
use Exception;

//  Classe CurriculumController é um Controller responsável por adição/remoção de currículo do usuário comum, 
//  atualização do arquivo do currículo do usuário comum, adicionar/remover interesses da empresa,
//  recuperar interesses da empresa
//  está diretamente ligado com as classes model System e Account 
class CurriculumController
{

    private $account;
    private $system;

    public function __construct(System $system, Account $account, FileHandler $fileHandler)
    {
        $this->account = $account;
        $this->system = $system;        
        $this->fileHandler = $fileHandler;
    }

    // Função na Controller para adicionar um novo currículo do usuário comum
    public function addCurriculum($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");

        // Recupera os parâmetros vindos pelo POST
        $params = $request->getPostParams();

        // Recupera o arquivo de currículo
        $files = $request->getFilesParams();
        
        // ****** Tratamento do arquivo ******
        // O arquivo de currículo proveniente do front é movido para a pasta public/curriculos
        // se ocorreu normalmente, o hash do arquivo é retornado 
        // caso algo dê errado uma exceção é lançada        
        $hashFile = $this->fileHandler->moveFile($files['file']['tmp_name']); 
        
        try {
            if(!$params['habilities']) {
                throw new Exception('Não foram passadas habilidades');
            }
            $this->system->addCurriculum(
                $params['area'], 
                $params['course'], 
                $hashFile, 
                $params['institute'], 
                $params['graduate_year'], 
                $id_user,
                $params['habilities']
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para adicionar novos interesses da empresa
    public function addInterests($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");

        // Recupera os parâmetros vindos pelo POST
        $params = $request->getPostParams();
        
        try {
            if(!$params['interests']) {
                throw new Exception('Não foram passados interesses');
            }
            $this->system->addInterests(
                $params['interests'],
                $id_user
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para remover um interesse de uma empresa
    public function deleteInterests($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");

        // Recupera os parâmetros vindos pelo POST
        $params = $request->getPostParams();
        
        try {
            $this->system->deleteInterests(
                $params['interests'],
                $id_user
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }    

    // Função na Controller para atualizar o arquivo de currículo do usuário comum
    public function updateCurriculum($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");

        // Recupera os parâmetros vindos pelo POST
        $params = $request->getPostParams();

        // Recupera o arquivo de currículo
        $files = $request->getFilesParams();
        
        // ****** Tratamento do arquivo ******
        // O arquivo de currículo proveniente do front é movido para a pasta public/curriculos
        // se ocorreu normalmente, o hash do arquivo é retornado 
        // caso algo dê errado uma exceção é lançada        
        $hashFile = $this->fileHandler->moveFile($files['file']['tmp_name']); 
        
        try {
            $this->system->updateCurriculum(
                $id_user,
                $hashFile,
                $params['habilities']
            );
            $rp = new ResponseHandler(200, 'ok', $files);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para "remover" o currículo do usuário comum -> Explicação das aspas no remove no arquivo Model/System.php
    public function removeCurriculum($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");

        try {
            $this->system->removeCurriculum(
                $id_user
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }   
    
    // Função na Controller para buscar os currículos ligados à uma lista de interesses fornecidos pelo usuário empresa
    public function searchCurByInt($request)
    {
        $params = $request->getQueryParams();

        try {
            $result = $this->system->searchCurByInt(
                $params
            );
            $rp = new ResponseHandler(200, '', $result);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }  
    
    // Função na Controller para buscar os currículos ligados à todos os interesses de um usuário empresa
    public function searchCurByAllInt($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");
        
        try {
            $result = $this->system->searchCurByAllInt(
                $id_user
            );
            $rp = new ResponseHandler(200, '', $result);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para buscar os interesses ligados à uma empresa
    public function searchInt($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");
        
        try {
            $result = $this->system->searchInt(
                $id_user
            );
            // Verifica se o resultado for false (ou seja, não encontrou nada)
            // retorna um vetor vazio, caso contrário, retorna os valores 
            // encontrados
            if(!$result){
                $rp = new ResponseHandler(200, '', []);                
            } else {
                $rp = new ResponseHandler(200, '', $result);
            }            
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função ma Controller para recuperar o currículo do usuário
    public function getCurriculum($request)
    {
        // Pega o token do header Authorization através da função pertencente ao account
        $token = $this->account->getToken();

        // Recupera o id do usuário contido no token
        $id_user = $this->account->get($token, "id");
        
        try {
            $result = $this->system->getCurriculum(
                $id_user
            );
            $rp = new ResponseHandler(200, '', $result);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

}
