<?php namespace CventApi;

use CventApi\CventLoginCredentials;
use CventApi\CventConnection;
use SoapFault;

class CventLogin {

  /**
   * @var \CventApi\CventLoginCredentials
   */
  protected $cventApiCredentials;

  /**
   * @var \CventApi\CventConnection
   */
  protected $connection;

  protected $results;

  public function __construct(CventConnection $connection, CventLoginCredentials $credentials) {
    $this->connection = $connection;
    $this->cventApiCredentials = $credentials;


    $this->_login();
  }

  private function _login() {
    $this->results = $this->connection->client()->Login($this->cventApiCredentials);

    if (!isset($this->results->LoginResult->LoginSuccess) || !$this->results->LoginResult->LoginSuccess) {
      throw new SoapFault("Cvent Api Login", "Cvent Api Login Failed " . $this->results->ErrorMessage);
    }

  }

  public function login(CventConnection $connection, CventLoginCredentials $credentials) {
    return new CventLogin($connection, $credentials);
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