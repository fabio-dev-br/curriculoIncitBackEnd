<?php

namespace IntecPhp\Model;

use IntecPhp\Entity\Curriculum;
use IntecPhp\Entity\User;
use IntecPhp\Entity\UserHability;
use IntecPhp\Entity\Interest;
use IntecPhp\Worker\EmailWorker;
use Exception;

//  Classe System é um Model responsável por tratar do cadastro de um novo currículo
//  está diretamente ligado com as entidades Curriculum, User e UserHability
class System
{
    private $curriculum;
    private $user;
    private $userHability;
    private $interestEntity;
    private $emailWorker;

    public function __construct(Curriculum $curriculum, User $user, UserHability $userHability, Interest $interest, EmailWorker $emailWorker)
    {
        $this->curriculum = $curriculum;
        $this->user = $user;
        $this->userHability = $userHability;
        $this->interestEntity = $interest;
        $this->emailWorker = $emailWorker;
    }

    // Função na Model para adicionar um novo currículo
    public function addCurriculum($area, $course, $hashFile, $institute, $graduateYear, $userId, $habilities)
    {
        // // Obtenção do dia e hora atual / referência: São Paulo / Para colocar no reg_date e reg_up da tabela curriculum
        // date_default_timezone_set('America/Sao_Paulo');
        //     // mktime - obtém um timestamp Unix do dia atual
        // $regDate  = mktime (date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
        //     // Converte o timestamp para o formato de data Y-m-d
        // $regDate = date('Y-m-d h:i:s', $regDate);
        // $regUp = $regDate;

        // // Verifica se existe uma linha do usuário, caso exista, é dado um update no registro existente, caso contrário, uma nova linha é inserida
        // $curriculumId = $this->curriculum->getCurriculum($userId);
        // if($curriculumId) {
        //     if(!$this->curriculum->update($area, $course, $hashFile, $regDate, $regUp, $institute, $graduateYear, $userId)) {
        //         throw new Exception('Não foi possivel fazer o cadastro do currículo');
        //     }
        // } else {
        //     // Insere o currículo na tabela, em caso de sucesso retorna o id do novo currículo, caso contrário, uma exceção é lançada
        //     $curriculumId = $this->curriculum->insert($area, $course, $hashFile, $regDate, $regUp, $institute, $graduateYear, $userId);
        //     if(!$curriculumId) {
        //         throw new Exception('Não foi possivel fazer o cadastro do currículo');
        //     }
        // }

        // // Após inserir o currículo, as habilidades são inseridas
        // foreach ($habilities as $hability) {
        //     $habilityId = $this->userHability->insert($hability, $curriculumId);
        // }

        // Verifica quais empresas possuem interesses nas habilidades do usuário
        // e seus e-mails são recuperados
        foreach ($habilities as $hability) {
            $idUsers[$hability] = $this->interestEntity->getUsersId($hability);        

            // A variável emails é limpa já que é utilizada mais de uma vez no loop
            $emails = NULL;
            foreach ($idUsers[$hability] as $idUser) {
                $emails[] = $this->user->getOnlyEmail($idUser); 
            }            

            // Envio dos e-mails
            foreach ($emails as $email) {
                $emailData['from_name'] = '';
                $emailData['from_email'] = '';
                $emailData['to_name'] = '';
                $emailData['subject_prefix'] = '';
                $emailData['subject'] = '';
                $emailData['bcc_email'] = '';
                $emailData['body'] = '';
                $emailWorker->execute($emailData);
            }            
        }
                
    }

    // Função na Model para adicionar novos interesses de uma empresa
    public function addInterests($interests, $userId)
    {
        // Insere os interesses na tabela, em caso de sucesso retorna o id do interesse adicionado, caso contrário, uma exceção é lançada
        foreach ($interests as $interest) {
            $interestId = $this->interestEntity->insert($interest, $userId);
            if(!$interestId) {
                throw new Exception('Não foi possivel fazer o cadastro do interesse');
            }
        }     
    }

    // Função na Model para excluir um interesse de uma empresa
    public function deleteInterest($interest, $userId)
    {
        // Exclui o interesse da tabela interest
        if(!$this->interestEntity->delete($interest, $userId)) {
            throw new Exception('Não foi possivel remover o interesse');
        }
    }

    // Função na Model para atualizar o arquivo de currículo do usuário comum
    public function updateCurriculum($userId, $hashFile)
    {
        // Obtenção do dia e hora atual / referência: São Paulo / Para colocar no reg_up da tabela curriculum
        date_default_timezone_set('America/Sao_Paulo');
            // mktime - obtém um timestamp Unix do dia atual
        $regUp  = mktime (date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
            // Converte o timestamp para o formato de data Y-m-d
        $regUp = date('Y-m-d h:i:s', $regUp);

        // Recupera as informações existentes do currículo do usuário em questão para serem passadas na função update abaixo
        // isso é feito, para a reutilização da função update
        $curriculum = $this->curriculum->getAllVars($userId, $hashFile, $regUp);
        if(!$curriculum) {
            throw new Exception('O usuário não possui um currículo para atualizar');
        }

        // Atualiza o arquivo do currículo na tabela curriculum
        if(!$this->curriculum->update($curriculum['area'], $curriculum['course'], $hashFile, $curriculum['reg_date'], $regUp, $curriculum['institute'], $curriculum['graduate_year'], $curriculum['id_user'])) {
            throw new Exception('A atualização não ocorreu adequadamente');
        }
    }

    // Função na Model para "excluir" o currículo do usuário comum, porém, na verdade o currículo não é excluído da tabela
    // mas é posto valor NULL no campo de id_file, para que quando o usuário adicionar outro currículo
    // não se crie entradas desnecessárias na tabela curriculum. Além disso, é necessários excluir todas as habilidades ligadas ao currículo 
    // excluído
    public function removeCurriculum($userId)
    {
        // O ID do currículo é recuperado ao fornecer o ID de usuário na função abaixo
        $idCurriculum = $this->curriculum->getCurriculum($userId);

        // Atualiza o arquivo do currículo na tabela curriculum a partir do ID do currículo
        if(!$this->curriculum->delete($idCurriculum)) {
            throw new Exception('A remoção do currículo não ocorreu adequadamente');
        }

        // Recupera as habilidades do usuário ligados ao currículo
        $habilities = $this->userHability->getHabilitiesByCurriculum($idCurriculum);

        // Cada habilidade relacionada ao currículo é removida da tabela
        foreach ($habilities as $hability) {
            if(!$this->userHability->delete($hability, $idCurriculum)) {
                throw new Exception('Não foi possivel fazer a remoção da habilidade do usuário');
            }
        }  
    }

    // Função na Model para buscar os currículos ligados à uma lista de interesses fornecidos pelo usuário empresa
    public function searchCurByInt($interests)
    {
        // Para cada interesse são recuperados todos os currículos relacionados à cada um
        // 1º São obtidos os id_curriculum da tabela user_hability se as habilidades do usuário são iguais aos interesses buscados
        // 2º Os currículos são obtidos a partir dos id_curriculum
        // 3º Os currículos encontrados são anexados à variável result de acordo com o interesse atual
        foreach ($interests as $interest) {
            $idCurricula[$interest] = $this->userHability->getCurriculaByHab($interest);
            if(!$idCurricula) {
                throw new Exception('Não há usuários com as habilidades desejadas');
            }

            // A variável curricula é limpa já que é utilizada mais de uma vez no loop
            $curricula = NULL;
            foreach ($idCurricula[$interest] as $idCurriculum) {
                $curricula[] = $this->curriculum->get($idCurriculum); 
            }
            $result[$interest] = $curricula;
        }  
        return $result;
    }

    // Função na Model para buscar os currículos ligados à todos os interesses de um usuário empresa
    public function searchCurByAllInt($userId)
    {
        // A partir do ID do usuário empresa são encontrados os interesses dela
        $interests = $this->interestEntity->getInterests($userId);
        // Para cada interesse são recuperados todos os currículos relacionados à cada um
        // 1º São obtidos os id_curriculum da tabela user_hability se as habilidades do usuário são iguais aos interesses buscados
        // 2º Os currículos são obtidos a partir dos id_curriculum
        // 3º Os currículos encontrados são anexados à variável result de acordo com o interesse atual
        foreach ($interests as $interest) {
            $idCurricula[$interest] = $this->userHability->getCurriculaByHab($interest);
            if(!$idCurricula) {
                throw new Exception('Não há usuários com as habilidades desejadas');
            }

            // A variável curricula é limpa já que é utilizada mais de uma vez no loop
            $curricula = NULL;
            foreach ($idCurricula[$interest] as $idCurriculum) {
                $curricula[] = $this->curriculum->get($idCurriculum); 
            }
            $result[$interest] = $curricula;
        }  
        return $result;
    }
}
