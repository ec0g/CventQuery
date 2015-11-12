<?php

require_once 'vendor/autoload.php';

use CventQuery\CventLoginCredentials;
use CventQuery\CventSoapClient;
use CventQuery\CventConnection;
use Dotenv\Dotenv;

$env = new Dotenv(__DIR__);
$env->load();

$client = CventSoapClient::connect(getenv('WSDL'),TRUE);
$creds = new CventLoginCredentials(getenv('ACCOUNT'),getenv('API_USERNAME'),getenv('API_PASSWORD'));

$conn = CventConnection::login($client,$creds);
/*
$params = new StdClass();
$params->ObjectType = 'Event';
$params->CvSearchObject=new StdClass();
$params->CvSearchObject->SearchType = 'OrSearch';

$query = new \CventQuery\QueryType\QueryBase($conn,'Search',$params);

$results = $query->call();

echo "<pre>";
print_r($results);
*/

//$sQuery = new \CventQuery\QueryType\SearchQuery($conn);

//$sQuery->on(new \CventQuery\CventObject\EventCventObject());

//$temp = $sQuery->get();
$event = new CventQuery\CventObject\Event();

$query = new \CventQuery\CventQuery($conn,$event);

$temp = $query->where('EventStatus','Completed',\CventQuery\SearchOperator::NOT_EQUAL_TO)->get();

print_r($temp);
//echo $conn->cventServerUrl();


