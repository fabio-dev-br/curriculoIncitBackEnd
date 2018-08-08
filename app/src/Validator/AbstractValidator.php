<?php

namespace IntecPhp\Validator;

abstract class AbstractValidator
{
	protected $errorMessage;
	protected $config;
	protected $elValue;

	function __construct($elValue, $config = [])
	{
		$this->elValue = $elValue;
		$this->config = $config;
		$this->errorMessage = "";
	}

	public abstract function getMessage();
	public abstract function isValid($inverse = false);
}
