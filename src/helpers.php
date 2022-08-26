<?php
if(!function_exists('mailer')) {
    function mailer(): \MDP\Mailer\Mailer
    {
        return new MDP\Mailer\Mailer();
    }
}