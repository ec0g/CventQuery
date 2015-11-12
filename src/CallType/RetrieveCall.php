<?php namespace CventQuery\CallType;

use CventQuery\CventObject\CventObjectInterface;

/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/10/15
 * Time: 12:24
 */
class RetrieveCall extends BaseCall {
  const RETRIEVE_CALL_NAME = "Retrieve";

  public function __construct(\CventQuery\CventConnection $connection, CventObjectInterface $cventObject) {
    parent::__construct($connection, self::RETRIEVE_CALL_NAME, $cventObject->type());
  }


  public function whereIds(array $ids)
  {
    $this->data->Ids = $ids;

    return $this;
  }

}