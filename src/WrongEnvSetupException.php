<?php

namespace MDP\Mailer;

class WrongEnvSetupException extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            'Env file is either not present or not properly configured. Don\'t forget to set up the: MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD and MAIL_ENCRYPTION variables, even if they hold empty fields. vlucas/dotenv package should be installed and properly configured. Please refer to this package\'s docs.',
            500
        );
    }
}