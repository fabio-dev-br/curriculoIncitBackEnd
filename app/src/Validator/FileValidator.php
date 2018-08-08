<?php

namespace IntecPhp\Validator;

/**
* Essa classe verifica se um arquivo foi inserido no campo, e se ele corresponde
* a um tamanho válido
*/
class FileValidator extends AbstractValidator
{
	/** @const mensagem padrão de erro */
	const DEFAULT_MESSAGE = "Árquivo inválido";
    const DEFAULT_FILE_SIZE = 5000000;

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
	* Verifica se o arquivo inserido $this->elValue é um arquivo válido
	*
	* @return bool retorna true se o arquivo for válido e false caso o contrário
	*/
	public function isValid($inverse = false)
	{
        $config = $this->config;
        $value = $this->elValue;

        if (!$value) {
            if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
            return false;
        }

		if (array_key_exists('empty', $config) && $config["empty"] && $value['error'] == UPLOAD_ERR_NO_FILE) {
			return true;
		}

		if ($value['error'] != UPLOAD_ERR_OK) {
			return false;
		}

        if (array_key_exists('mime', $config) && !in_array($value['type'], $config['mime'])) {
            if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
            return false;
        }
        if (array_key_exists('size', $config) && $value['size'] > $config['size']) {
            if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
            return false;
        }
        if ($value['size'] > self::DEFAULT_FILE_SIZE) {
            if (array_key_exists('message', $this->config)) {
				$this->errorMessage = $this->config['message'];
			} else {
				$this->errorMessage = self::DEFAULT_MESSAGE;
			}
            return false;
        }
		return true;
	}
}
