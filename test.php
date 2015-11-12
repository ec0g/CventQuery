<?php

require_once 'vendor/autoload.php';

use CventQuery\CventLoginCredentials;
use CventQuery\CventSoapClient;
use CventQuery\CventConnection;
use Dotenv\Dotenv;

$env = new Dotenv(__DIR__);
$env->load();

$client = CventSoapClient::connect(getenv('WSDL'), TRUE);
$creds = new CventLoginCredentials(getenv('ACCOUNT'), getenv('API_USERNAME'), getenv('API_PASSWORD'));

//$conn = CventConnection::login($client,$creds);
$storedCventSession = [
  'value' => 'nF7LxZbXgLlinTq857qBFOQAcHLPtgOGDwRM+3sKCPBA/0rR3x68VBMClKtf/VO6L5iKoQfzMyfKTdATQeWQ7bbqebVLP9Es6hMYeWdxLk4b2vPi7jZx38zxV+91zlGNmT1sBA0poKDW/VgmV81k9kQILcPgOHBOxN6ULXL6maly2leiWVgmrTyUJhfLONUDMFClMuTh6j2OKuBHIAdn42Xnb1FWpC3vm/OohbAiOQgLA6eiIFDlCd2KePJZBFhleDXKwSg0NTuMtbWqlsnfytXLYKhAxesCC58a7xaF39qoSJZqJRR2iF3bVjzfsUOuCVXdvh4Ee+jjgBU6J/4y/VT5+/In0voURuHj1xxJPVviJocsl/8Ck5uLR7VhDSqUSXFK8KgJa45VCWfD4gCF9rUx6qr4RZO7Td1F9CXB86ansFayocVpS4vbwgCcR8smAXm88dlexyv2rdzGjQ3RgJVk8+6PzCF11upsdCIAO7V7UIMkgNFpOR6InsviqaD27ue4O6GUSi/CTgVL9ussdTfJo8DWWBJsbPd7GavlM6/rE82sDAa7vH8InXlBuw24OMasiIYruoxP7sRFsY7UZfLkXzUJz712/r9AGgGLw/iysK1cvC7Dbnx1do16kxNMUMbQ3lx1LqoduQohMdvQL5FwPbSDi++Ii7jhTa8XvixU/lGQlLYoGGwlG2jheZTUlqph25egLjmEIsZ6fsFuCGG9JfaqrOH2/sNw7bVBfH7ogp8DFhGrAnu60/DWTT/8h3lMJECyUurlLfoyXJSPUZr+qJOw6ZiSZesdankfDIPkSbmpZfsdTCZ3q4+nwwgNlGHZUfuxFFL6JYDBnroqyejrccr+2e9+54PhpvYDkbKuFjO2I5FtPOdwY6p/zq3BhZ63TRP3xPsvjs/kVaoeIABi++EM6uxFATYc5MFx/E2p2LGFzEnJ/MFeQl0d6Bqc0K0uTSH3kdnQqdir8Oo+w38kY8ZnasT5+RHmLjfqmpfCTRMP0ouWw5G/JTU1E/fFwsGXJPc9NE7UtvPxKXsGBdmtrmpsMhivOprHVXJl0XYIh/yUKwvEeimfkQl9rpUJxQx87QYtm9czZGCs+EIE6X8sri34HJApuv3b8giWZvTZYgcfKuwCUUxciBHElGfgrQ8rlgLTziCmsoG68MgvQ9t23NVJ2fO/yQOzRLI/F6DLEtgJ2BJqj7wTB3wZ0fbep80pDxBeJeDty9gkiNPc+lX7FISKt6Ru4D70vEVoBPiZi/sCAz+3+0pgmpnp/V9rcUcmY2jr9mniZWj4D9GE/Kc97/StZ+kYrjFbGPM3n67MGVWE4Wyv90vD7TaXkCBYpttKsPocpN7WSEp6pFtXAvNMu5PWSoHRki76RNsgWHlzrVXqzBfCpoV3PUTIDN8MPobW0Gu4dZsm5Sb9lUS+pA==',
  'url' => getenv('CVENT_SOAP_URL'),
  'expires' => 1447357735,
];

$conn = new CventConnection($client, $creds, $storedCventSession);
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

$query = new \CventQuery\CventQuery($conn, $event);

$temp = $query->where('EventStatus', 'Completed', \CventQuery\SearchOperator::NOT_EQUAL_TO)->get();

print_r($temp);
//echo $conn->cventServerUrl();


