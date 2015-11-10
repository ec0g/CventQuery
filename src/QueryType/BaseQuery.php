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
   * @var mixed array|stdClass
   */
  protected $parameters;

  /**
   * BaseQuery constructor.
   *
   * @param \CventQuery\CventConnection $connection
   * @param String                      $cventCallName
   */
  public function __construct(CventConnection $connection, $cventCallName, $queryParameters) {
    $this->conn = $connection;
    $this->callName = $cventCallName;

    $this->parameters = $queryParameters;
  }

  /**
   * @return array
   *
   * @throws \SoapFault
   */
  public function call() {

    $results = [];

    try {
      $results = $this->conn->request($this->callName, $this->parameters);
    } catch (\SoapFault $e) {
      return $e->getMessage();
    }

    return $results;
  }

}