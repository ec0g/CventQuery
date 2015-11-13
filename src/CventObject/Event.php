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

  //Event status
  const EVENT_STATUS_COMPLETED = "Completed";
  const EVENT_STATUS_PENDING = "Pending";
  const EVENT_STATUS_ACTIVE = "Active";
  const EVENT_STATUS_CLOSED = "Closed";

  //available event fields
  const FIELD_EVENT_TITLE = 'EventTitle';
  const FIELD_EVENT_STATUS = 'EventStatus';

  /**
   * EventCventObject constructor.
   *
   * @param string $type
   */
  public function __construct() {
    parent::__construct(CventObjectType::EVENT);
  }

}