<?php

namespace IntecPhp\Controller;

use Pheanstalk\Pheanstalk;
use IntecPhp\Model\Contact;
use IntecPhp\Model\ResponseHandler;
use Exception;

//  Classe CurriculumController é um Controller responsável por adição/remoção de currículo do usuário comum, 
//  atualização do arquivo do currículo do usuário comum, adicionar/remover interesses da empresa, está diretamente ligado com a classe model System 
class CurriculumController
{

    private $system;

    public function __construct($system)
    {
        $this->system = $system;
    }

    // Função na Controller para adicionar um novo currículo de usuário comum
    public function addCurriculum($request)
    {
        $params = $request->getPostParams();
        
        try {
            if(!$params['habilities']) {
                throw new Exception('Não foram passadas habilidades');
            }
            $this->system->addCurriculum(
                $params['area'], 
                $params['course'], 
                $params['id_file'], 
                $params['institute'], 
                $params['graduate_year'], 
                $params['id_user'],
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
        $params = $request->getPostParams();
        
        try {
            if(!$params['interests']) {
                throw new Exception('Não foram passados interesses');
            }
            $this->system->addInterests(
                $params['interests'],
                $params['id_user']
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para remover um interesse de uma empresa
    public function deleteInterest($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->system->deleteInterest(
                $params['interest'],
                $params['id_user']
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
        $params = $request->getPostParams();
        
        try {
            $this->system->updateCurriculum(
                $params['id_user'],
                $params['id_file']
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }

    // Função na Controller para "remover" o currículo do usuário comum -> Explicação das aspas no remove no arquivo Model/System.php
    public function removeCurriculum($request)
    {
        $params = $request->getPostParams();
        
        try {
            $this->system->removeCurriculum(
                $params['id_user']
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
        $params = $request->getPostParams();
        
        try {
            $this->system->searchCurByInt(
                $params['interests']
            );
            $rp = new ResponseHandler(200);
        } catch (Exception $ex) {
            $rp = new ResponseHandler(400, $ex->getMessage());
        }

        $rp->printJson();
    }   
}
