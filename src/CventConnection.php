<?php namespace CventQuery;

use CventQuery\CventLoginCredentials;
use CventQuery\CventSoapClient;
use SoapFault;

class CventConnection {

  /**
   * @var \CventQuery\CventLoginCredentials
   */
  protected $cventApiCredentials;

  /**
   * @var \CventQuery\CventSoapClient
   */
  protected $cventSoapClient;

  /**
   * Stores the login request return information.
   *
   * @var \stdClass
   */
  protected $results;

  /**
   * @var String
   */
  protected $cventSessionHeaderValue;

  /**
   * The expiration time of the cvent session header. By deafault it should expire one hour from the
   * time it was issued.
   * @var int
   */
  protected $cventSessionHeaderExpires;

  /**
   * @var String
   */
  protected $cventSoapUrl;

  /**
   * CventConnection constructor.
   *
   * @param \CventQuery\CventSoapClient       $client
   * @param \CventQuery\CventLoginCredentials $credentials
   * @param array                             $cventSession
   *  Session header array has the following keys:
   *    'value','url','expires'
   */
  public function __construct(CventSoapClient $client, CventLoginCredentials $credentials, array $cventSession=[]) {

    $this->cventSessionHeaderExpires = 0;

    $this->cventSoapClient = $client;
    $this->cventApiCredentials = $credentials;

    if(!empty($cventSession['value'])){
      $this->saveCventSessionHeaderValue($cventSession['value']);
    }

    if(!empty($cventSession['expires']) && is_numeric($cventSession['expires'])){
      $this->cventSessionHeaderExpires = $cventSession['expires'];
    }

    if(!empty($cventSession['url'])){
      $this->cventSoapUrl = $cventSession['url'];
    }
  }

  /**
   *
   * @throws \BadMethodCallException
   * @throws \SoapFault
   */
  private function login() {

    $this->results = $this->cventSoapClient->client()->Login($this->cventApiCredentials);

    if (!isset($this->results->LoginResult->LoginSuccess) || !$this->results->LoginResult->LoginSuccess) {
      throw new SoapFault("Cvent Api Login", "Cvent Api Login Failed " . $this->results->ErrorMessage);
    }

    $this->cventSessionHeaderValue = $this->results->LoginResult->CventSessionHeader;
    $this->cventSessionHeaderExpires = time();

    $this->setSoapEndpoint();
    $this->setSoapSessionHeader();
  }

  private function setSoapSessionHeader() {
    $soapHeader = new \SoapHeader('http://api.cvent.com/2006-11','CventSessionHeader', $this->cventSessionHeader());
    $this->cventSoapClient->setHeader($soapHeader);
  }

  private function setSoapEndpoint(){
    $this->cventSoapClient->setLocation($this->results->LoginResult->ServerURL);
  }

  public function cventSessionExpired(){
    return $this->cventSessionHeaderExpires < time();
  }

  /**
   * Saves the cvent session header value (if pulled from cache for ex.) and sets it's
   * expiration.
   *
   * @param $header String
   * @param $expires UTC time
   */
  public function saveCventSessionHeaderValue($header,$expires=null)
  {
    $this->cventSessionHeaderValue = $header;

    if(empty($expires) || !is_numeric($expires)){
      $this->cventSessionHeaderExpires = time() + 3600;
    }else{
      $this->cventSessionHeaderExpires = $expires;
    }
  }

  public function getCventSessionHeaderValue()
  {
    return $this->cventSessionHeaderValue;
  }

  public function getCventSessionExpiration()
  {
    return $this->cventSessionHeaderExpires;
  }

  /**
   * @param $method String The name of the soap method to call
   * @param $data Mixed data, usually an object
   *
   * @throws SoapFault
   *
   * @return mixed
   */
  public function request($method, $data) {
    /*if($this->cventSessionHeaderExpires < time()){
      $this->login();
    }else{
      $this->setSoapSessionHeader();
    }*/
    $this->login();

   //return $this->cventSoapClient->client()->$method($data);
    return $this->cventSoapClient->call($method,$data);
  }

  /**
   * @return array
   */
  public function cventSessionHeader() {
    $val = [];
    if(!empty($this->cventSessionHeaderValue)){
      $val = ['CventSessionValue' => $this->cventSessionHeaderValue];
    }
    return $val;
  }

  /**
   * @return String
   */
  public function cventServerUrl() {
    return $this->results->LoginResult->ServerURL;
  }

}