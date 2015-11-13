<?php namespace CventQuery\CallType;
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/13/15
 * Time: 15:44
 */

interface CallTypeInterface {

  /**
   * @return String Returns the name of the function to call
   */
  public function method();


  /**
   * @return stdClass Returns formatted data to be sent.
   */
  public function data();
}