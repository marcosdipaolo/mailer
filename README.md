# Mailer
## A PHP Mailer library
Mailer is a super simple mail package wrapping the Symfony `SwiftMailer`
### Dependencies
This package -as a standalone- has a dependency that has to be manually installed. This of course applies if your app doesn't already have it installed.  

This dependency is the `vlucas\phpdotenv` package. 
```
composer require vlucas/phpdotenv
```
Also, a properly configured `env` file

### Environmental Variables

This package needs the following variables set up in you env file, at least as a empty field:
```dotenv
MAIL_HOST
MAIL_USERNAME
MAIL_PASSWORD
MAIL_PORT
MAIL_ENCRYPTION
```
### Usage
With the helper `mailer()` which is the same as `new MDP\Mailer`
```php
mailer()->send($subject, $mailFrom, $nameFrom, $recipients, $body);
```
You can add as a sixth parameter the **priority** as an integer, being `1` the highest and `5` the lowest.
This can be achieved also using the swiftmailer constants:
```php
Swift_Mime_SimpleMessage::PRIORITY_HIGHEST; // 1
Swift_Mime_SimpleMessage::PRIORITY_HIGH; // 2
Swift_Mime_SimpleMessage::PRIORITY_NORMAL; // 3
Swift_Mime_SimpleMessage::PRIORITY_LOW; // 4
Swift_Mime_SimpleMessage::PRIORITY_LOWEST; // 5
```
