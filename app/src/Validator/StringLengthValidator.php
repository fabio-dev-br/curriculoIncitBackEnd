<?php
	namespace IntecPhp\Validator;

	/**
	* Essa classe verifica se o número de caracteres do valor informado corresponde
	* ao intervalo mínimo e máximo para validação
	*/
	class StringLengthValidator extends AbstractValidator{
		/** @const mensagem padrão de erro */
		const DEFAULT_MESSAGE = "O tamanho fornecido está fora do intervalo permitido";

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
		* Verifica se o número de caracteres de um valor $this->elValue está
		* dentro do intervalo de caracteres permitidos para validação
		*
		* @return bool retorna true se o número de caracteres do valor estiver
		* dentro do intervalo permitido e false caso o contrário
		*/
		public function isValid($inverse = false)
		{
			if (array_key_exists('maxLength', $this->config) && mb_strlen($this->elValue) > $this->config['maxLength']) {
				if (array_key_exists('message', $this->config)) {
					$this->errorMessage = $this->config['message'];
				} else {
					$this->errorMessage = self::DEFAULT_MESSAGE;
				}

				return false;
			}

			if (array_key_exists('minLength', $this->config) && mb_strlen($this->elValue) < $this->config['minLength']) {
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
