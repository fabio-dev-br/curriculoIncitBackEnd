<?php

namespace IntecPhp\Validator;

/**
* Essa classe verifica se um valor numérico foi inserido no campo ou não
*/
class IsNumericValidator extends AbstractValidator
{
	/** @const mensagem padrão de erro */
	const DEFAULT_MESSAGE = "Este campo deve ser numérico ou vazio";

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
	* Verifica se um valor $this->elValue corresponde a um valor numérico ou não
	*
	* @return bool retorna true se o valor for numérico e false caso o contrário
	*/
	public function isValid($inverse = false)
	{
        if($this->elValue==''){
            return true;
        }

		if (!is_numeric($this->elValue)) {
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
