<?php namespace CventApi;

use SoapClient;
use SoapFault;
use \CventApi\CventLoginCredentials;


class CventConnection {

  /**
   * @var String
   */
  protected $wsdl;

  /**
   * @var SoapClient
   */
  protected $soapClient;

  /**
   * @var array
   */
  protected $soapOptions;


  protected $cventSessionHeader;
  protected $loginResult;

  public function __construct($wsdl=null) {

    $this->wsdl = $wsdl;

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
   * @return \SoapClient
   */
  public function client()
  {
    return $this->soapClient;
  }

  /**
   *
   * @return $this
   */
  public function connect() {
    $this->soapClient = new SoapClient($this->wsdl, $this->soapOptions);
    return $this->soapClient;
  }


}
