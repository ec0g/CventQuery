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

  public function __construct(CventObjectInterface $cventObject) {
    parent::__construct(self::RETRIEVE_CALL_NAME, $cventObject->type());
  }

  /**
   * @param array $ids An array of object's IDs to retrieve
   *
   * @return $this
   */
  public function whereIds(array $ids)
  {
    $this->data->Ids = $ids;

    return $this;
  }

}