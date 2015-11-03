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

    if(empty($wsdl)){
      throw new \InvalidArgumentException("We need a wsdl file");
    }

    $this->wsdl = $wsdl;

    $this->soapOptions = [
      'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
    ];

    $this->soapClient = new SoapClient($this->wsdl, $this->soapOptions);
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
   * @return CventConnection
   */
  public static function connect($wsdl=null) {

    return new CventConnection($wsdl);
  }


}
