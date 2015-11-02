<?php namespace CventApi;

use SoapClient;
use SoapFault;
use CventApi\CventLoginCredentials;


class CventConnect {


  protected $wsdl;
  protected $soapClient;
  protected $soapOptions;
  protected $cventApiCredentials;


  protected $cventSessionHeader;
  protected $loginResult;

  public function __construct($wsdl, CventLoginCredentials $credentials) {

    $this->wsdl = $wsdl;

    $this->cventApiCredentials = $credentials;

    $this->soapOptions = [
      'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
    ];
  }

  public function debug($trace = 1, $exceptions = 1) {
    $this->soapOptions += [
      'trace' => $trace,
      'exceptions' => $exceptions
    ];

    return $this;
  }

  /**
   *
   *
   * @return $this
   */
  public function connect() {
    $this->soapClient = new SoapClient($this->wsdl, $this->soapOptions);
    return $this;
  }

  /**
   *
   * @throws SoapFault
   */
  public function login() {
    $this->loginResult = $this->soapClient->Login($this->cventApiCredentials);

    if(isset($this->loginResult->LoginResult->CventSessionHeader)){
      $this->cventSessionHeader = [
        'CventSessionValue' => $this->loginResult->LoginResult->CventSessionHeader,
      ];
    }

    return $this;
  }

  public function getLoginResults()
  {
    return $this->loginResult;
  }


}
