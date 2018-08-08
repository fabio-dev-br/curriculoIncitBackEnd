<?php

namespace IntecPhp\Validator;

/**
* Essa classe verifica se um valor passado está dentro de um conjunto de
* valores informados
*/
class InArrayValidator extends AbstractValidator
{

	/** @const mensagem padrão de erro */
	const DEFAULT_MESSAGE = "value is not allowed";

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
	* Verifica se o valor informado $this->elValue é um dos valores em
	* $this->config["allowedValues"])
	*
	* @return bool retorna true se o valor informado estiver contido em $this->config["allowedValues"])
	* e false caso o contrário
	*/
	public function isValid($inverse = false)
	{
        $value = $this->elValue;
        $config = $this->config;

        if ($value == null) {
            $this->errorMessage = self::DEFAULT_MESSAGE;
            return false;
        }

        if (in_array($value, $config["allowedValues"])) {
            return true;
        }

        $this->errorMessage = self::DEFAULT_MESSAGE;
        return false;
    }
}
