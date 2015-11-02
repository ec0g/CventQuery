<?php namespace CventApi;

class CventLoginCredentials {

  /*
   * @var String
   */
  public $accountNumber;

  /**
   * @var String
   */
  public $username;

  /**
   * @var String
   */
  public $password;


  public function __construct($accountNumber=null,$username=null,$password=null) {

    $this->AccountNumber = $accountNumber;
    $this->UserName = $username;
    $this->Password = $password;

  }

}