<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/5/15
 * Time: 14:35
 */

namespace CventQuery\CventObject;

use CventQuery\CventObject\BaseCventObject;
use stdClass;


/**
 * File: EventCventObject.php
 * Author: goce
 * Created:  2015.11.05
 *
 * Description:
 */
class EventCventObject extends BaseCventObject {

  const CVENT_OBJECT_NAME = "Event";

  private $searchObject;

  private $orSearch = 'OrSearch';
  private $andSearch = 'AndSearch';

  /**
   * EventCventObject constructor.
   *
   * @param string $type
   */
  public function __construct() {
    parent::__construct(self::CVENT_OBJECT_NAME);

    $this->parameters = new stdClass();
    $this->parameters->ObjectType = self::CVENT_OBJECT_NAME;

    // default parameters for the search object
    $this->searchObject = new stdClass();
    $this->searchObject->SearchType = $this->orSearch;
  }

  public function prepared() {
    $this->parameters->CvSearchObject = new stdClass();
    $this->parameters->CvSearchObject = $this->searchObject;

    return $this->parameters();
  }

  public function setParameter($name, $value) {
    $this->searchObject->$name = $value;
  }
}