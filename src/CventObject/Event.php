<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/5/15
 * Time: 14:35
 */

namespace CventQuery\CventObject;

use CventQuery\CventObject\BaseCventObject;
use CventQuery\QueryType\SearchQuery;
use stdClass;


/**
 * File: EventCventObject.php
 * Author: goce
 * Created:  2015.11.05
 *
 * Description:
 */
class Event extends BaseCventObject {

  /**
   * EventCventObject constructor.
   *
   * @param string $type
   */
  public function __construct() {
    parent::__construct(CventObjectType::EVENT);
  }

}