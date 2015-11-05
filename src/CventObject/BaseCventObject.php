<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/5/15
 * Time: 14:37
 */

namespace CventQuery\CventObject;

use CventObjectInterface;

/**
 * File: BaseCventObject.php
 * Author: goce
 * Created:  2015.11.05
 *
 * Description:
 */
class BaseCventObject implements CventObjectInterface{

  protected $type;

  public function __construct($type="") {
    if(empty($type)){
      throw new \InvalidArgumentException("The CventObject type must be delcared");
    }

    $this->type = $type;

  }

  public function type()
  {
    return $this->type;
  }

}