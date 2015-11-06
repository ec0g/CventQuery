<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/4/15
 * Time: 11:50
 */

namespace CventQuery\QueryType;

use CventQuery\CventConnection;
use BadMethodCallException;
use CventQuery\CventObject\CventObjectInterface;

/**
 * File: QueryBase.php
 * Author: goce
 * Created:  2015.11.04
 *
 * Description:
 */
class BaseQuery implements QueryTypeInterface {

  /**
   * @var CventConnection
   */
  protected $conn;

  /**
   * @var String The Cvent call type. Ex. Search, Retrieve, etc...
   */
  protected $callName;


  /**
   * @var CventObjectInterface
   */
  protected $cventObject;

  /**
   * BaseQuery constructor.
   *
   * @param \CventQuery\CventConnection $connection
   * @param String                      $cventCallName
   */
  public function __construct(CventConnection $connection, $cventCallName) {
    $this->conn = $connection;
    $this->callName = $cventCallName;
  }

  public function get() {
    return $this->call();
  }


  /**
   * @return array
   *
   * @throws \SoapFault
   */
  private function call() {

    $results = [];

    try {
      $results = $this->conn->request($this->callName, $this->cventObject->prepared());
    } catch (\SoapFault $e) {
      echo $e->getMessage();
    }

    return $results;
  }

  public function where($paramName,$value,$operator) {
    throw new BadMethodCallException("You have to implement this method as it applies to the query call type");
  }

  public function on(CventObjectInterface $cventObjectType) {
    $this->cventObject = $cventObjectType;
    return $this;
  }


}