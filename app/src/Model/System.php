<?php

namespace IntecPhp\Model;

use IntecPhp\Entity\Curriculum;
use IntecPhp\Entity\User;
use IntecPhp\Entity\UserHability;
use Exception;

//  Classe System é um Model responsável por tratar do cadastro de um novo currículo
//  está diretamente ligado com as entidades Curriculum, User e UserHability
class System
{
    private $curriculum;
    private $user;
    private $userHability;

    public function __construct(Curriculum $curriculum, User $user, UserHability $userHability)
    {
        $this->curriculum = $curriculum;
        $this->user = $user;
        $this->userHability = $userHability;
    }

    // Função na Model para adicionar um novo currículo
    public function addCurriculum($area, $course, $idFile, $institute, $graduateYear, $userId, $habilities)
    {
        // Obtenção do dia e hora atual / referência: São Paulo / Para colocar no reg_date e reg_up da tabela curriculum
        date_default_timezone_set('America/Sao_Paulo');
            // mktime - obtém um timestamp Unix do dia atual
        $regDate  = mktime (date("m")  , date("d"), date("Y"));
            // Converte o timestamp para o formato de data Y-m-d
        $regDate = date('Y-m-d', $regDate);
        $regUp = $regDate;
        // Insere o currículo na tabela, em caso de sucesso retorna o id do novo currículo, caso contrário, uma exceção é lançada
        $curriculumId = $this->curriculum->insert($area, $course, $idFile, $regDate, $regUp, $institute, $graduateYear, $userId);
        if(!$curriculumId) {
            throw new Exception('Não foi possivel fazer o cadastro do currículo');
        }
        // Após inserir o currículo, as habilidades são inseridas
        foreach ($habilities as $hability) {

        }
    }
}
