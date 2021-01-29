# Mailer
## A PHP Mailer library
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
