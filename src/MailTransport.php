<?php

namespace Sinevia\Mail;

use GuzzleHttp\ClientInterface;
use Illuminate\Mail\Transport\Transport;

class MailTransport extends Transport {

    protected $client;
    protected $key;
    protected $domain;
    protected $url;

    public function __construct(ClientInterface $client, $key, $domain) {
        $this->key = $key;
        $this->client = $client;
        $this->setDomain($domain);
    }

    public function send(\Swift_Mime_SimpleMessage $message, &$failedRecipients = null) {
        $this->beforeSendPerformed($message);

        //$options = ['auth' => ['api', $this->key]];
        //$message->setBcc([]);

        $from = [];
        $to = [];
        $cc = [];
        $bcc = [];

        foreach ($message->getFrom() as $email => $name) {
            $from[] = (is_null($name) ? $email : $name) . ' <' . $email . '>';
        }

        foreach ($message->getTo() as $email => $name) {
            $to[] = (is_null($name) ? $email : $name) . ' <' . $email . '>';
        }
        if ($message->getCc() != null) {
            foreach ($message->getCc() as $email => $name) {
                $cc[] = (is_null($name) ? $email : $name) . ' <' . $email . '>';
            }
        }
        if ($message->getBcc() != null) {
            foreach ($message->getBcc() as $email => $name) {
                $bcc[] = (is_null($name) ? $email : $name) . ' <' . $email . '>';
            }
        }
        
        $options['form_params'] = [
            'From' => implode(',', $from),
            'To' => implode(',', $to),
            'Cc' => implode(',', $cc),
            'Bcc' => implode(',', $bcc),
            'Text' => $message->getContentType(),
            'Html' => $message->getBody(),
            'Subject' => $message->getBody(),
            'Token' => $this->key,
        ];

        return $this->client->post($this->url, $options);
    }

    public function getKey() {
        return $this->key;
    }

    public function setKey($key) {
        return $this->key = $key;
    }

    public function getDomain() {
        return $this->domain;
    }

    public function setDomain($domain) {
        $this->url = $domain;
        return $this->domain = $domain;
    }

}
