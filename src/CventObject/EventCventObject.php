<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/5/15
 * Time: 14:35
 */

namespace CventQuery\CventObject;

use CventQuery\CventObject\BaseCventObject;


/**
 * File: EventCventObject.php
 * Author: goce
 * Created:  2015.11.05
 *
 * Description:
 */
class EventCventObject extends BaseCventObject {


  /**
   * EventCventObject constructor.
   *
   * @param string $type
   */
  public function __construct() {
    parent::__construct("Event");
  }

  public function parameters() {
    return $this->parameters;
  }
}