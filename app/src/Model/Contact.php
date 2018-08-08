<?php

namespace IntecPhp\Model;

class Contact
{
    private $toEmail;

    public function __construct(string $toEmail)
    {
        $this->toEmail = $toEmail;
    }

    public function parseData($name, $email, $message)
    {
        return [
            'to_name' => 'Admin',
            'to_email' => $this->toEmail,
            'fake_from_name' => $name,
            'fake_from_email' => $email,
            'subject' => 'Formulário de Contato',
            'body' => $message
        ];
    }
}
