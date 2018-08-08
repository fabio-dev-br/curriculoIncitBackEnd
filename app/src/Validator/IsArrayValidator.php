<?php

namespace IntecPhp\Validator;

/**
* Essa classe verifica se um campo é um array ou não
*/
class IsArrayValidator extends AbstractValidator
{
	/** @const mensagem padrão de erro */
    const DEFAULT_MESSAGE = "Valor informado deve ser um conjunto de valores";
    const DEFAULT_NOT_SUBSET_MESSAGE = "Valores fora do permitido";

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
	* Verifica se $this->elValue é um array e, caso necessário, se é subconjunto do array $this->config['subsetOf']
	*
	* @return bool retorna true se $this->elValue é um array ou, se $this->config['subsetOf'] for informado, se é subconjunto de $this->config['subsetOf'], false caso contrário
	*/
	public function isValid($inverse = false)
	{

        if(!is_array($this->elValue)) {
            $this->errorMessage = $this->config['message'] ?? self::DEFAULT_MESSAGE;
            return false;
        }

        if(isset($this->config['subsetOf']) && array_diff($this->elValue, $this->config['subsetOf'])) {
            $this->errorMessage = $this->config['message'] ?? self::DEFAULT_NOT_SUBSET_MESSAGE;
            return false;
        }


		$this->errorMessage = "";
		return true;
	}
}
