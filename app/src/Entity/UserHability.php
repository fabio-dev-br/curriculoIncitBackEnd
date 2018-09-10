<?php

namespace IntecPhp\Entity;

// Entidade UserHability é responsável por lidar com a tabela user_hability
class UserHability extends AbstractEntity
{
    // Variáveis herdadas da classe pai e sobrescritas para permitir a utilização correta das funções da classe abstrata 
    // Nome da tabela
    protected $name = 'user_hability';
    
    // Id
    protected $id = 'id';

    // Função que verifica a quais currículos uma habilidade está ligada, em caso de sucesso retorna um lista contendo 
    // todos os IDs dos currículos, caso contrário, retorna false
    public function getCurriculaByHab($hability)
    {
        $stm = $this->conn->query("select distinct id_curriculum from user_hability where hability = ?", [$hability]);
        if($stm) {
            // Variável stms recebe todas as linhas encontradas na tabela user_hability com tal habilidade
            $stms =  $stm->fetchAll();

            // Se existe algum valor no stms os IDs dos currículos são recuperados, caso contrário retorna false
            if($stms) {
                // O vetor curriculaId receberá todos os IDs dos currículos encontrados
                foreach ($stms as $curriculumId) {
                    $curriculaId[] = $curriculumId['id_curriculum'];
                }
                if($curriculaId) {
                    return $curriculaId;
                }
            }      
        }
        return false;
    }

    // Função que insere a habilidade na tabela, em caso de sucesso retorna o ID da habilidade nova, caso contrário, retorna false
    public function insert($hability, $curriculumId)
    {
        $stm = $this->conn->query("insert into user_hability (hability, id_curriculum) 
            values (?, ?)", [
                $hability, 
                $curriculumId
            ]
        );
        
        // Caso a query tenha ocorrido perfeitamente o ID da habilidade inserida é retornado à classe System
        if($stm) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // Função que recupera todas as habilidade ligadas à um currículo, em caso de sucesso retorna um lista contendo todos as habilidade
    // , caso contrário, retorna false
    public function getHabilitiesByCurriculum($curriculumId)
    {
        $stm = $this->conn->query("select hability from user_hability where id_curriculum = ?", [$curriculumId]);
        if($stm) {
            // Variável stms recebe todas as linhas encontradas na tabela user_hability com tal ID de currículo
            $stms =  $stm->fetchAll();

            // Se existe algum valor no stms as habilidades ligadas ao currículo são recuperadas, caso contrário retorna false
            if($stms) {
                // O vetor habilities receberá todos as habilidades ligados ao currículo
                foreach ($stms as $hability) {
                    $habilities[] = $hability['hability'];
                }
                if($habilities) {
                    return $habilities;
                }
            }
        }
        return false;
    }

    // Função que "remove" o habilidade da tabela user_hability a partir do nome da habilidade e o ID do currículo
    public function delete($hability, $curriculumId)
    {
        $stm = $this->conn->query("delete from user_hability where hability = ? and id_curriculum = ?" , [
                $hability,
                $curriculumId
            ]
        );

        // Caso a query tenha ocorrido perfeitamente retorna true
        if($stm) {
            return true;
        }
        return false;
    }
}
