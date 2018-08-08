<?php

namespace IntecPhp\Validator;

/* estrutura do config
	[
		elName => [
			validators => [
				ClassValidator => config,
				...
			]
		],
		...
	]
*/

class InputValidator {
	private $data;
	private $errors;
    private $config;
    private $generalErrorMessage;

	function __construct($config) {
		$this->config = $config;
		$this->errors = [];
        $this->data = [];
        $this->generalErrorMessage = '';
	}

	public function setData($data) {
		$this->data = $data;
	}

	public function getErrorsMessages() {
		return $this->errors;
	}

	public function isValid() {


        $isValid = true;
        $notSetFields = [];

		foreach($this->config as $elName => $elValue) {
            if (!array_key_exists("validators", $elValue)) continue;

            if(!isset($this->data[$elName])) {
               if(empty($elValue["optional"])) {
                   $notSetFields[] = $elName;
                   $isValid = false;
               }
           } else {

                if(!empty($elValue["context"])) {
                    foreach($elValue["context"] as $field => $value) {
                        if($this->data[$field] != $value) {
                            unset($this->config[$elName]);
                            break;
                        }
                    }
                    continue;
                }

                foreach($elValue["validators"] as $validatorName => $validatorConfig ) {
                    $classPath = __NAMESPACE__ . "\\".$validatorName;

                    $validator = new $classPath($this->data[$elName] ?? null, $validatorConfig);

                    // validação inversa ou não
                    $inverse = $validatorConfig['inverse'] ?? false;

                    if (!$validator->isValid($inverse)) {
                        $this->errors[$elName] = $validator->getMessage();
                        $isValid = false;
                        break;
                    }
                }
            }
        }

        if($notSetFields) {
            $this->generalErrorMessage = 'Campos não preenchidos: ' . implode(', ', $notSetFields);
        }

        return $isValid;
    }

    public function getGeneralErrorMessage()
    {
        return $this->generalErrorMessage;
    }
}
