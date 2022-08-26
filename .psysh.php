<?php

use Dotenv\Dotenv;

// Automatically autoload Composer dependencies
if (is_file(getcwd() . '/vendor/autoload.php')) {
    require_once getcwd() . '/vendor/autoload.php';
}

// Load environmental variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();