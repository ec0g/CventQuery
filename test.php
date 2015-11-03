<?php

require_once 'vendor/autoload.php';

use CventApi\CventLogin;
use CventApi\CventLoginCredentials;
use Dotenv\Dotenv;

$env = new Dotenv(__DIR__);
$env->load();

///$login = new CventLogin(getenv('WSDL'))->

