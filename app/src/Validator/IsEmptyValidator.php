<?php

namespace IntecPhp\Validator;

/**
* Essa classe verifica se um campo está vazio ou não
*/
class IsEmptyValidator extends AbstractValidator
{
	/** @const mensagem padrão de erro */
	const DEFAULT_MESSAGE = "Este campo não pode ser vazio";

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
	* Verifica se um valor $this->elValue foi inserido no campo
	*
	* @return bool retorna true se o campo não estiver vazio e false caso o contrário
	*/
	public function isValid($inverse = false)
	{
		if (empty($this->elValue)) {
			if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}

			return false;
		}

		$this->errorMessage = "";
		return true;
	}
}
