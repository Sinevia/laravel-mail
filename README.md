# Laravel Mail

Laravel package for sending mail via the Sinevia Web Serices API

## Installation ##

Install the package via composer

```
composer require sinevia/laravel-mail
```

## Configuration ##

After publishing, add and fill the next values to your .env file

```
MAIL_DRIVER=sinevia_mail
```

Add and fill the next values to your config/services file

```
'sinevia_mail' => [
    'domain' => 'http://ws.sinevia.com/mails/mail-send',
    'secret' => 'APIKEY',
],
```

## How to Use? ##

```php
\Mail::raw('EMAILS WORKING TEXT', function ($message) {
    $message->from('mail@server.com','From Name');
    $message->to('to@server.com','To Name');
    $message->cc('cc@server.com','Cc Name');
    $message->bcc('bcc@server.com','Bcc Name');
    $message->subject("EMAILS WORKING SUBJECT");
});

// check for failures
if (\Mail::failures()) {
    dd('FAILED');
}
        
dd('SUCCESS');
```
