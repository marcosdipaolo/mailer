<?php
if(!function_exists('mailer')) {
    function mailer()
    {
        return new MDP\Mailer\Mailer();
    }
}