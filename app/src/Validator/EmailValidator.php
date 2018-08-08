<?php

namespace IntecPhp\Validator;

/**
* Essa classe verifica se o e-mail é válido ou não
*/
class EmailValidator extends AbstractValidator
{
	/** @const mensagem padrão de erro */
	const DEFAULT_MESSAGE = "E-mail inválido";

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
	* Verifica se o e-mail $this->elValue é válido
	*
	* @return bool retorna true se o e-mail for válido e false caso o contrário
	*/
	public function isValid($inverse = false)
	{

		// o email é válido?
		if (filter_var($this->elValue, FILTER_VALIDATE_EMAIL)){
			// sim
			$this->errorMessage = "";
			return true;
		}

		// não
		// pega a mensagem fornecida ou a messagem padrão caso não exista uma
		// específica
		$this->errorMessage = $this->config['message'] ?? self::DEFAULT_MESSAGE;
		return false;
	}
}
