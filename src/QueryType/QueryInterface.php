<?php namespace CventQuery\QueryType;
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/4/15
 * Time: 10:41
 */

interface QueryInterface {

  /**
   * @return void
   */
  public function call();

  /**
   * @return String
   */
  public function type();

  /**
   * @return array
   */
  public function data();
}