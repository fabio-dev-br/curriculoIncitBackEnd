<?php

namespace IntecPhp\Worker;

use Tx\Mailer;

class EmailWorker
{
    private $txMailler;
    private $config;

    public function __construct(Mailer $txMailler, array $config)
    {
        $this->txMailler = $txMailler;
        $this->config = $config;
    }

    public function execute(array $emailData)
    {
        $ec = $this->config;

        $fromName = $emailData['from_name'] ?? $ec['default_from_name'];
        $fromEmail = $emailData['from_email'] ?? $ec['default_from'];
        $fakeFromName = $emailData['fake_from_name'] ?? $ec['default_from_name'];
        $fakeFromEmail = $emailData['fake_from_email'] ?? $ec['default_from'];

        $this->txMailler
            ->addTo($emailData['to_name'], $emailData['to_email'])
            ->setSubject($ec['subject_prefix'] . $emailData['subject'])
            ->setFrom($fromName, $fromEmail)
            ->setFakeFrom($fakeFromName, $fakeFromEmail);

        if($ec['default_bcc']) {
            $this->txMailler->addBcc($ec['default_from_name'], $ec['default_from']);
        }

        if (isset($emailData['bcc_email'])) {
            $this->txMailler->addBcc($emailData['bcc_name'] ?? '', $emailData['bcc_email']);
        }

        $this->txMailler->setBody($emailData['body']);

        if (isset($emailData['attachments'])) {
            foreach ($emailData['attachments'] as $attachment) {
                $this->txMailler->addAttachment($attachment['name'], $attachment['dir']);
            }
        }

        $result = $this->txMailler->send();
    }
}
