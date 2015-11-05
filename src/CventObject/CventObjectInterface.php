<?php namespace CventQuery\CventObject;

interface CventObjectInterface {

  /**
   * @return string
   */
  public function type();

  /**
   * May return an object or array, depending on the CventQuery Type needs and CventObject field availability
   *
   * @return mixed
   */
  public function parameters();

  /**
   * @return mixed Returns a perpared cvent object which can be used in a SOAP call
   */
  public function prepared();


  /**
   * @param $name
   * @param $value
   *
   * @return mixed
   */
  public function setParameter($name,$value);
}