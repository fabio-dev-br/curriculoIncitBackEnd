<?php

namespace IntecPhp\Model;

use IntecPhp\Entity\Curriculum;
use IntecPhp\Entity\User;
use IntecPhp\Entity\UserHability;
use IntecPhp\Entity\Interest;
use IntecPhp\Worker\EmailWorker;
use Exception;
use Pheanstalk\Pheanstalk;

//  Classe System é um Model responsável por tratar do cadastro de um novo currículo
//  está diretamente ligado com as entidades Curriculum, User e UserHability
class System
{
    private $curriculum;
    private $user;
    private $userHability;
    private $interestEntity;
    private $emailProducer;

    public function __construct(
        Curriculum $curriculum, 
        User $user, 
        UserHability $userHability, 
        Interest $interest,
        Pheanstalk $emailProducer
        )
    {
        $this->curriculum = $curriculum;
        $this->user = $user;
        $this->userHability = $userHability;
        $this->interestEntity = $interest;
        $this->emailProducer = $emailProducer;
    }

    // Função na Model para adicionar um novo currículo
    public function addCurriculum(
        $area, 
        $course, 
        $hashFile, 
        $institute, 
        $graduateYear, 
        $userId, 
        $habilities
        )
    {
        // Obtenção do dia e hora atual / referência: São Paulo / Para colocar no reg_date e reg_up da tabela curriculum
        date_default_timezone_set('America/Sao_Paulo');
        
        // mktime - obtém um timestamp Unix do dia atual
        $regDate  = mktime (date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
        
        // Converte o timestamp para o formato de data Y-m-d
        $regDate = date('Y-m-d h:i:s', $regDate);
        $regUp = $regDate;

        // Verifica se existe uma linha do usuário, caso exista, é dado um update no registro existente, 
        // caso contrário, uma nova linha é inserida
        $curriculumId = $this->curriculum->getCurriculumId($userId);
        if($curriculumId) {
            if(!$this->curriculum->update(
                $area, 
                $course, 
                $hashFile, 
                $regDate, 
                $regUp, 
                $institute, 
                $graduateYear, 
                $userId)
            ) {
                throw new Exception('Não foi possivel fazer o cadastro do currículo');
            }
        } else {
            // Insere o currículo na tabela, em caso de sucesso retorna o id do novo currículo, caso contrário, uma exceção é lançada
            $curriculumId = $this->curriculum->insert(
                $area, 
                $course, 
                $hashFile, 
                $regDate, 
                $regUp, 
                $institute, 
                $graduateYear, 
                $userId
            );
            if(!$curriculumId) {
                throw new Exception('Não foi possivel fazer o cadastro do currículo');
            }
        }

        // Após inserir o currículo, as habilidades são inseridas
        foreach ($habilities as $hability) {
            $habilityId = $this->userHability->insert($hability, $curriculumId);
            if(!$habilityId) {
                throw new Exception('Não foi possivel fazer o cadastro da habilidade ' + $hability);
            }
        }

        // Verifica quais empresas possuem interesses nas habilidades do usuário
        // e seus e-mails são recuperados para um posterior envio
        foreach ($habilities as $hability) {
            // Se não existirem empresas com interesse na habilidade, nessa iteração ($idUsers = NULL),
            // pula para a próxima habilidade
            if(($idUsers = $this->interestEntity->getUsersId($hability)) == NULL){
                continue;
            }

            // A variável emails é limpa já que é utilizada mais de uma vez no loop
            $emails = NULL;
            foreach ($idUsers as $idUser) {
                $emails[] = $this->user->getOnlyEmail($idUser); 
            }            

            // Envio dos e-mails
            foreach ($emails as $email) {
                $this
                    ->emailProducer
                    ->put(json_encode([
                        'to_name' => 'alguem',
                        'to_email' => $email,
                        'subject_prefix' => '[Currículo Adicionado] ',
                        'subject' => "Interesse: $hability",
                        'body' => sprintf("Um novo currículo foi adicionado à plataforma, 
                        referente ao interesse %s. Visite a plataforma para mais informações.", $hability),
                    ]));
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
    public function deleteInterests($interests, $userId)
    {
        // Exclui os interesses da tabela interest
        foreach ($interests as $interest) {
            if(!$this->interestEntity->delete($interest, $userId)) {
                throw new Exception('Não foi possivel remover o interesse');
            }
        }
    }

    // Função na Model para atualizar o arquivo de currículo do usuário comum
    public function updateCurriculum(
        $userId, 
        $hashFile, 
        $newHabilities
        )
    {
        // ** Remoção das habilidades antigas **
        // Recupera o id do currículo pertencente ao usuário
        $curriculumId = $this->curriculum->getCurriculumId($userId);

        // Recupera as habilidades do usuário ligados ao currículo
        $habilities = $this->userHability->getHabilitiesByCurriculum($curriculumId);

        // Cada habilidade relacionada ao currículo é removida da tabela
        foreach ($habilities as $hability) {
            if(!$this->userHability->delete($hability, $curriculumId)) {
                throw new Exception('Não foi possivel fazer a remoção da habilidade do usuário');
            }
        }         

        // Obtenção do dia e hora atual / referência: São Paulo / Para colocar no reg_up da tabela curriculum
        date_default_timezone_set('America/Sao_Paulo');
        
        // mktime - obtém um timestamp Unix do dia atual
        $regUp  = mktime (date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
        
        // Converte o timestamp para o formato de data Y-m-d
        $regUp = date('Y-m-d h:i:s', $regUp);

        // Recupera as informações do currículo para o update,
        // isso é necessário pois o update é utilizado tanto 
        // na atualização do currículo quanto na adição se o
        // usuário já possui um registro na tabela de currículo
        $curriculum = $this->curriculum->getCurriculum($userId);
        
        // Atualiza o arquivo do currículo na tabela curriculum
        if(!$this->curriculum->update(
            $curriculum['area'], 
            $curriculum['course'], 
            $hashFile, 
            $curriculum['reg_date'], 
            $regUp, 
            $curriculum['institute'], 
            $curriculum['graduate_year'], 
            $curriculum['id_user'])
        ) {
            throw new Exception('A atualização não ocorreu adequadamente');
        }
        
        // Insere as novas habilidades
        foreach ($newHabilities as $hability) {
            $habilityId = $this->userHability->insert($hability, $curriculumId);
            if(!$habilityId) {
                throw new Exception('Não foi possivel fazer o cadastro da habilidade ' + $hability);
            }
        }

        // Verifica quais empresas possuem interesses nas habilidades do usuário
        // e seus e-mails são recuperados para um posterior envio
        foreach ($newHabilities as $hability) {
            // Se não existirem empresas com interesse na habilidade, nessa iteração ($idUsers = NULL),
            // pula para a próxima habilidade
            if(($idUsers = $this->interestEntity->getUsersId($hability)) == NULL){
                continue;
            }
            
            // A variável emails é limpa já que é utilizada mais de uma vez no loop
            $emails = NULL;
            foreach ($idUsers as $idUser) {
                $emails[] = $this->user->getOnlyEmail($idUser); 
            }            

            // Envio dos e-mails
            foreach ($emails as $email) {
                $this
                    ->emailProducer
                    ->put(json_encode([
                        'to_name' => 'alguem',
                        'to_email' => $email,
                        'subject_prefix' => '[Currículo Adicionado] ',
                        'subject' => "Interesse: $hability",
                        'body' => sprintf("Um novo currículo foi adicionado à plataforma, 
                        referente ao interesse %s. Visite a plataforma para mais informações.", $hability),
                    ]));
            }
        }
    }

    // Função na Model para "excluir" o currículo do usuário comum, porém, na verdade o currículo não é excluído da tabela
    // mas é posto valor NULL no campo de id_file, para que quando o usuário adicionar outro currículo
    // não se crie entradas desnecessárias na tabela curriculum. Além disso, é necessários excluir todas as habilidades ligadas ao currículo 
    // excluído
    public function removeCurriculum($userId)
    {
        // O ID do currículo é recuperado ao fornecer o ID de usuário na função abaixo
        $idCurriculum = $this->curriculum->getCurriculumId($userId);

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
    // Caso não exista currículos relacionados à habilidade, NULL é retornado no índice relacionado ao interesse
    public function searchCurByInt($interests)
    {
        // Para cada interesse são recuperados todos os currículos relacionados à cada um
        // 1º São obtidos os id_curriculum da tabela user_hability se as habilidades do usuário são iguais aos interesses buscados
        // 2º Os currículos são obtidos a partir dos id_curriculum
        // 3º Os currículos encontrados são anexados à variável result de acordo com o interesse atual
        foreach ($interests as $interest) {
            // Declaração da variável curricula, a qual armazena os currículos encontrados
            $curricula = NULL;            
            $idCurricula[$interest] = $this->userHability->getCurriculaByHab($interest);
            
            // Se não existe currículos ligados ao interesse dado, o elemento do vetor
            // idCurricula, cujo índice é o interesse, recebe NULL
            if(!$idCurricula[$interest]) {
                $idCurricula[$interest] = NULL;                
            } else {
                foreach ($idCurricula[$interest] as $idCurriculum) {
                    // Declaração da variável aux, a qual recebe todas as informações
                    // da linha na tabela
                    $aux = NULL;
                    $aux = $this->curriculum->get($idCurriculum);
    
                    // O nome do usuário relacionado ao currículo é recuperado
                    $name = $this->user->get($aux["id_user"]);
                    $name = $name['name'];

                    // Converte o formato da data de update para d-m-Y h:i:s
                    $upDate = date('d-m-Y h:i:s', strtotime($aux['reg_up']));

                    // As habilidades ligadas ao currículo do usuário são recuperadas
                    $habilities = $this->userHability->getHabilitiesByCurriculum($idCurriculum);

                    // Para o armazenamento em curricula é feito uma seleção de apenas
                    // colunas relevantes
                    $curricula[] = array(
                        'name' => $name,
                        'area' => $aux['area'], 
                        'course' => $aux['course'], 
                        'graduate_year' => $aux['graduate_year'],  
                        'hash_file' => $aux['hash_file'],
                        'institute' => $aux['institute'], 
                        'reg_up' => $upDate,
                        'habilities' => $habilities
                    );
                }
            }                
            $result[$interest] = $curricula;            
        }  

        // Nessa função sempre será retornado result, caso não existam currículos relacionados à um 
        // certo interesse, NULL é retorna nesse índice
        return $result;
    }

    // Função na Model para buscar os currículos ligados à todos os interesses de um usuário empresa
    public function searchCurByAllInt($userId)
    {
        // A partir do ID do usuário empresa são encontrados os interesses dela
        $interests = $this->interestEntity->getInterests($userId);

        // Caso a empresa não possua interesses ainda, é lançada uma exceção
        if(!$interests) {
            throw new Exception('Este usuário empresa não possui interesses ainda');
        }

        // Para cada interesse são recuperados todos os currículos relacionados à cada um
        // 1º São obtidos os id_curriculum da tabela user_hability se as habilidades do usuário são iguais aos interesses buscados
        // 2º Os currículos são obtidos a partir dos id_curriculum
        // 3º Os currículos encontrados são anexados à variável result de acordo com o interesse atual
        foreach ($interests as $interest) {
            // Declaração da variável curricula, a qual armazena os currículos encontrados
            $curricula = NULL;  
            $idCurricula[$interest] = $this->userHability->getCurriculaByHab($interest);

            // Se não existe currículos ligados ao interesse dado, o elemento do vetor
            // idCurricula, cujo índice é o interesse, recebe NULL
            if(!$idCurricula[$interest]) {
                $idCurricula[$interest] = NULL;                
            } else {
                foreach ($idCurricula[$interest] as $idCurriculum) {
                    // Declaração da variável aux, a qual recebe todas as informações
                    // da linha na tabela
                    $aux = NULL;
                    $aux = $this->curriculum->get($idCurriculum);
                    
                    // O nome do usuário relacionado ao currículo é recuperado
                    $name = $this->user->get($aux["id_user"]);
                    $name = $name['name'];

                    // Converte o formato da data de update para d-m-Y h:i:s
                    $upDate = date('d-m-Y h:i:s', strtotime($aux['reg_up']));

                    // As habilidades ligadas ao currículo do usuário são recuperadas
                    $habilities = $this->userHability->getHabilitiesByCurriculum($idCurriculum);

                    // Para o armazenamento em curricula é feito uma seleção de apenas
                    // colunas relevantes
                    $curricula[] = array(
                        'name' => $name,
                        'area' => $aux['area'], 
                        'course' => $aux['course'], 
                        'graduate_year' => $aux['graduate_year'],  
                        'hash_file' => $aux['hash_file'],
                        'institute' => $aux['institute'], 
                        'reg_up' => $upDate,
                        'habilities' => $habilities 
                    );
                }
            }
            $result[$interest] = $curricula;
        } 
        
        // Nessa função sempre será retornado result, caso não existam currículos relacionados à um 
        // certo interesse, NULL é retorna nesse índice
        return $result;
    }

    // Função na Model para buscar os interesses ligados à uma empresa
    public function searchInt($userId)
    {
        // A partir do ID do usuário empresa são encontrados os interesses dela
        $interests = $this->interestEntity->getInterests($userId);        
        return $interests;
    }

    // Função na Model para recuperar o currículo
    public function getCurriculum($userId)
    {
        // A partir do ID do usuário pessoa é encontrado o currículo dela
        $aux = $this->curriculum->getCurriculum($userId);

        // Converte o formato da data de update para d-m-Y h:i:s
        $upDate = date('d-m-Y h:i:s', strtotime($aux['reg_up']));

        // O nome do usuário relacionado ao currículo é recuperado
        $name = $this->user->get($userId);
        $name = $name['name'];

        // As habilidades ligadas ao currículo do usuário são recuperadas
        $habilities = $this->userHability->getHabilitiesByCurriculum($aux['id']);

        // Para o armazenamento em curriculum é feito uma seleção de apenas
        // colunas relevantes
        $curriculum = array(
            'name' => $name,
            'area' => $aux['area'], 
            'course' => $aux['course'], 
            'graduate_year' => $aux['graduate_year'],  
            'hash_file' => $aux['hash_file'],
            'institute' => $aux['institute'], 
            'reg_up' => $upDate,
            'habilities' => $habilities
        );
        return $curriculum;
    }
}
