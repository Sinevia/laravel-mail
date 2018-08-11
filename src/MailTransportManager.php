<?php

namespace Sinevia\Mail;

use Illuminate\Mail\TransportManager;

class MailTransportManager extends TransportManager {

    protected function createSineviaMailDriver() {
        $config = $this->app['config']->get('services.sinevia_mail', []);

        return new MailTransport(
                $this->guzzle($config), $config['secret'], $config['domain']
        );
    }

}
