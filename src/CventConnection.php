<?php namespace CventApi;

use CventApi\CventLoginCredentials;
use CventApi\CventSoapClient;
use SoapFault;

class CventConnection {

  /**
   * @var \CventApi\CventLoginCredentials
   */
  protected $cventApiCredentials;

  /**
   * @var \CventApi\CventSoapClient
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

  }

  public static function login(CventSoapClient $client, CventLoginCredentials $credentials) {
    return new CventConnection($client, $credentials);
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
    return $this->results->ServerURL;
  }

}