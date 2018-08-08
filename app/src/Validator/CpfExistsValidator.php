<?php

namespace IntecPhp\Validator;

use IntecPhp\Entity\User;

/**
* Essa classe verifica se o cpf já foi cadastrado ou não
*/
class CpfExistsValidator extends AbstractValidator
{
    /** @const mensagem padrão de erro */
    const DEFAULT_MESSAGE = "Cpf não existe";
    const DEFAULT_INVERSE_MESSAGE = "Cpf já existe";

    /**
    * Retorna a Mensagem de erro
    *
    * @return string
    */
    public function getMessage()
    {
        return $this->errorMessage;
    }

    /**
    * Verifica se o cpf $this->elValue já foi cadastrado
    *
    * @return bool retorna true se o cpf já foi cadastrado e false caso o contrário
    */
    public function IsValid($inverse = false)
    {
        $u = User::exists($this->elValue, User::FIELD_CPF);

        if ($inverse) {
            // o cpf já foi cadastrado?
            if ($u) {
                // sim
                // pega a mensagem fornecida ou a messagem padrão caso não exista uma específica
                $this->errorMessage = $this->config['message'] ?? self::DEFAULT_INVERSE_MESSAGE;
                return false;
            }

            $this->errorMessage = "";
            return true;
        }

        if ($u) {
            // sim
            $this->errorMessage = "";
            return true;
        }

        //  pega a mensagem fornecida ou a messagem padrão caso não exista uma específica
        $this->errorMessage = $this->config['message'] ?? self::DEFAULT_MESSAGE;
        return false;
    }
}
