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

  protected $results;

  public function __construct(CventSoapClient $client, CventLoginCredentials $credentials) {
    $this->cventSoapClient = $client;
    $this->cventApiCredentials = $credentials;


    $this->_login();
  }

  /**
   *
   * @throws \BadMethodCallException
   * @throws \SoapFault
   */
  private function _login() {

    $this->results = $this->cventSoapClient->client()->Login($this->cventApiCredentials);

    if (!isset($this->results->LoginResult->LoginSuccess) || !$this->results->LoginResult->LoginSuccess) {
      throw new SoapFault("Cvent Api Login", "Cvent Api Login Failed " . $this->results->ErrorMessage);
    }

    $this->setSoapHeader();
  }

  private function setSoapHeader() {
    $soapHeader = new \SoapHeader($this->results->LoginResult->ServerURL, 'CventSessionHeader', $this->results->LoginResult->CventSessionHeader);
    $this->cventSoapClient->client()->__setSoapHeaders($soapHeader);
  }

  public static function login(CventSoapClient $client, CventLoginCredentials $credentials) {
    return new CventConnection($client, $credentials);
  }

  /**
   * @param $method The name of the soap method to call
   * @param $data Mixed data, usually an object
   *
   * @throws SoapFault
   *
   * @return mixed
   */
  public function request($method, $data) {
   return $this->cventSoapClient->client()->__call($method,$data);
  }

  /**
   * @return array
   */
  public function cventSessionHeader() {
    return ['CventSessionValue' => $this->results->LoginResult->CventSessionHeader];
  }

  /**
   * @return String
   */
  public function cventServerUrl() {
    return $this->results->LoginResult->ServerURL;
  }

}