<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/9/15
 * Time: 17:30
 */

namespace CventQuery\QueryType;


/**
 * File: RetrieveQuery.php
 * Author: goce
 * Created:  2015.11.09
 *
 * Description:
 */
class RetrieveQuery extends BaseQuery {

  const RETRIEVE_CALL_NAME = "Retrieve";

  protected $ids;

  public function __construct(\CventQuery\CventConnection $connection) {
    parent::__construct($connection, self::RETRIEVE_CALL_NAME);

    $this->ids = [];
  }

  public function id(array $ids){
    if(empty($ids)){
      throw new \InvalidArgumentException("Invalid values detected. ");
    }

    $this->ids = $ids;

    return $this;
  }

}