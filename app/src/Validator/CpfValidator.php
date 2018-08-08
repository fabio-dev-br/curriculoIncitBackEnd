<?php
namespace IntecPhp\Validator;

/**
* Essa classe verifica se o CPF informado é válido ou não
*/
class CpfValidator extends AbstractValidator
{
	/** @const mensagem padrão de erro */
	const DEFAULT_MESSAGE = "CPF inválido";

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
	* Verifica se o valor informado $this->elValue é um CPF válido
	*
	* @return bool retorna true se o CPF for válido e false caso o contrário
	*/
	public function isValid($inverse = false)
	{
		$cpf = preg_replace('/[^0-9]/', '', (string) $this->elValue);
		$sum = 0;

		if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
			if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
			return false;
		}

		// Primeiro dígito verificador
		for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
			$sum += $cpf{$i} * $j;

		$mod = $sum % 11;

		if ($cpf{9} != ($mod < 2 ? 0 : 11 - $mod)) {
			if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
			return false;
		}

		// Segundo dígito verificador
		for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--)
			$sum += $cpf{$i} * $j;

		$mod = $sum % 11;

		$valid = $cpf{10} == ($mod < 2 ? 0 : 11 - $mod);
		if (!$valid) {
			if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
		}

		return $valid;
	}
}
