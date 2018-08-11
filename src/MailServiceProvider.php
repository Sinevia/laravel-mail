<?php

namespace Sinevia\Mail;

use Illuminate\Support\ServiceProvider;

class MailServiceProvider extends \Illuminate\Mail\MailServiceProvider {

    protected function registerSwiftTransport() {
//        if ($this->app['config']['mail.driver'] == 'sinevia_mail') {
//            $this->app['swift.mailer'] = $this->app->share(function ($app) {
//                return new \Swift_Mailer(new SineviaMailTransport());
//            });

            $this->app->singleton('swift.transport', function ($app) {
                return new MailTransportManager($app);
            });
//        } else {
//            parent::registerSwiftMailer();
//        }
    }

}
