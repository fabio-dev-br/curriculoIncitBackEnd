<?php

namespace IntecPhp\Entity;

// Entidade Curriculum é responsável por lidar com a tabela curriculum
class Curriculum extends AbstractEntity
{
    // Variáveis herdadas da classe pai e sobrescritas para permitir a utilização correta das funções da classe abstrata 
    // Nome da tabela
    protected $name = 'curriculum';
    // Id
    protected $id = 'id';

    // Função que verifica se o currículo de um usuário existe na tabela, em caso de sucesso retorna o id do currículo, caso contrário, retorna false
    public function getCurriculum($userId)
    {
        $stm = $this->conn->query("select * from curriculum where id_user = ?", [$userId]);
        if($stm) {
            $curriculum =  $stm->fetch();
            if($curriculum) {
                return $curriculum['id_user'];
            }
        }
        return false;
    }

    // Função que insere o currículo na tabela, em caso de sucesso retorna o ID do currículo novo, caso contrário, retorna false
    public function insert($area, $course, $idFile, $regDate, $regUp, $institute, $graduateYear, $userId)
    {
        $stm = $this->conn->query("insert into curriculum (area, course, id_file, reg_date, reg_up, institute, graduate_year, id_user) 
            values (?, ?, ?, ?, ?, ?, ?, ?)", [
                $area, 
                $course, 
                $idFile, 
                $regDate, 
                $regUp, 
                $institute, 
                $graduateYear, 
                $userId
            ]
        );
        
        // Caso a query tenha ocorrido perfeitamente o ID do usuário inserido é retornado à classe Access
        if($stm) {
            return $this->conn->lastInsertId();
        }
        return false;
    }
}
