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
  public function call();

}