<?php namespace CventQuery\QueryType;

use CventQuery\CventObject\CventObjectInterface;

/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/4/15
 * Time: 10:41
 */

interface QueryTypeInterface {

  /**
   * @return array
   */
  public function get();

  /**
   * The type of cvent object(ObjectType). Ex. Event, Contact, etc...
   * Please see the cvent documentation or wsdl doc for a full list of available ObjectTypes
   *
   * @return mixed
   */
  public function on(CventObjectInterface $cventObjectType);

  /**
   *
   * @return mixed
   */
  public function where($paraName,$value,$operator);

}