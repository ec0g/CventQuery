<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/4/15
 * Time: 11:50
 */

namespace CventQuery\QueryType;

use CventQuery\CventConnection;

/**
 * File: QueryBase.php
 * Author: goce
 * Created:  2015.11.04
 *
 * Description:
 */
class QueryBase implements QueryInterface {

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
  public function __construct(CventConnection $connection, $callType, $parameters) {
    $this->params = $parameters;
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


}