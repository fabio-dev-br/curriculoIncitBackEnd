<?php

namespace IntecPhp\Validator;
use DateTime;

/**
* Essa classe verifica se a data informada é válida ou não
*/
class DateValidator extends AbstractValidator
{
	/** @const mensagem padrão de erro */
	const DEFAULT_MESSAGE = "Data inválida";

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
	* Verifica se o valor informado $this->elValue é uma data válida
	*
	* @return bool retorna true se a data for válida e false caso o contrário
	*/
	public function isValid($inverse = false)
	{
        $v = $this->elValue;
        $c = $this->config;

        $d = DateTime::createFromFormat($c['format'], $v);

        if(!$d) {
            if (array_key_exists('message', $c)) {
				$this->errorMessage = $c['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
			return false;
        }

		return true;
	}
}
