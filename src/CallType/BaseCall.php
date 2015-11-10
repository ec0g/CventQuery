<?php namespace CventQuery\CallType;

use CventQuery\CventConnection;
use CventQuery\CventObject\CventObjectType;
use stdClass;

abstract class BaseCall {

  /**
   * @var CventConnection
   */
  protected $connection;

  /**
   * @var String
   */
  protected $callName;

  /**
   * @var stdClass
   */
  protected $data;

  public function __construct(CventConnection $connection, $callName, $objectType) {
    $this->connection = $connection;

    $this->callName = $callName;

    $this->data = new stdClass();
    $this->data->ObjectType = $objectType;
  }

  /**
   * @return mixed
   *
   * @throws \SoapFault
   */
  public function runQuery() {
    return $this->connection->request($this->callName, $this->data);
  }

  public function setParameter($paramName,$value){
    $this->data->{$paramName} = $value;
  }


  public function withData(stdClass $data) {
    $this->data = $data;

    return $this;
  }

}