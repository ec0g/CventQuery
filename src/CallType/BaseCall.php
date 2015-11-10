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
   * @var mixed
   */
  protected $data;

  public function __construct(CventConnection $connection, $callName, $data) {
    $this->connection = $connection;

    $this->callName = $callName;
    $this->data = $data;
  }

  /**
   * @return mixed
   *
   * @throws \SoapFault
   */
  public function runQuery() {
    return $this->connection->request($this->callName, $this->data);
  }


  public function withData($data) {
    $this->data = $data;

    return $this;
  }
}