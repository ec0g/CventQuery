<?php

require_once 'vendor/autoload.php';

use CventApi\CventLogin;
use CventApi\CventLoginCredentials;
use Dotenv\Dotenv;

$env = new Dotenv(__DIR__);
$env->load();

$conn = \CventApi\CventConnection::connect(getenv('WSDL'));
$creds = new CventLoginCredentials(getenv('ACCOUNT'),getenv('API_USERNAME'),getenv('API_PASSWORD'));


