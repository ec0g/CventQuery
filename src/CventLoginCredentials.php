<?php namespace CventApi;

class CventLoginCredentials {

  /*
   * @var String
   */
  public $AccountNumber;

  /**
   * @var String
   */
  public $UserName;

  /**
   * @var String
   */
  public $Password;


  public function __construct($accountNumber=null,$username=null,$password=null) {

    $this->AccountNumber = $accountNumber;
    $this->UserName = $username;
    $this->Password = $password;

  }

}