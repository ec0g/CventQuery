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

/**
 * File: QueryBase.php
 * Author: goce
 * Created:  2015.11.04
 *
 * Description:
 */
class BaseQuery implements QueryTypeInterface {

  /**
   * @var String
   */
  protected $type;

  /**
   * @var mixed
   */
  protected $params;

  /**
   * @var CventConnection
   */
  protected $conn;

  /**
   * QueryBase constructor.
   *
   * @param $type
   * @param $parameters
   */
  public function __construct(CventConnection $connection, $callType="", $parameters=null) {
    $this->params = !empty($parameters) ?: new \stdClass();
    $this->conn = $connection;
    $this->type = $callType;
  }


  /**
   * @return array
   *
   * @throws \SoapFault
   */
  public function call() {

    $results = [];

    try {
      $results = $this->conn->request($this->type,$this->params);
    } catch (\SoapFault $e) {
      echo $e->getMessage();
    }

    return $results;
  }

  /**
   * @return String
   */
  public function type() {
    return $this->type;
  }

  /**
   * @return mixed
   */
  public function data() {
    return $this->params;
  }

  public function where(){
    throw new BadMethodCallException("You have to implement this method as it applies to the query type");
  }

  public function on(){
    throw new BadMethodCallException("You have to implement this method as it applies to the query type");
  }




}