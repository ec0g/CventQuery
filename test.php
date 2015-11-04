<?php

require_once 'vendor/autoload.php';

use CventQuery\CventLoginCredentials;
use CventQuery\CventSoapClient;
use CventQuery\CventConnection;
use Dotenv\Dotenv;

$env = new Dotenv(__DIR__);
$env->load();

$client = CventSoapClient::connect(getenv('WSDL'));
$creds = new CventLoginCredentials(getenv('ACCOUNT'),getenv('API_USERNAME'),getenv('API_PASSWORD'));

$conn = CventConnection::login($client,$creds);

echo $conn->cventServerUrl();


