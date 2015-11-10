<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/4/15
 * Time: 17:30
 */

namespace CventQuery\QueryType;

use CventQuery\CventConnection;
use CventQuery\CventObject\CventObjectInterface;
use CventQuery\CventObject\EventCventObject;
use stdClass;

/**
 * File: SearchQuery.php
 * Author: goce
 * Created:  2015.11.04
 *
 * Description:
 */
class SearchQuery extends BaseQuery {


  private $orSearch = 'OrSearch';
  private $andSearch = 'AndSearch';

  private $searchObject;
  private $parameters;

  protected $cventObject;

  public function __construct(CventConnection $connection, CventObjectInterface $cventObject){

    // default parameters for the search object
    $this->searchObject = new stdClass();
    $this->searchObject->SearchType = $this->orSearch;

    $this->parameters = new stdClass();
    $this->parameters->ObjectType = $cventObject->type();
    $this->parameters->CvSearchObject = new stdClass();
    $this->parameters->CvSearchObject = $this->searchObject;

    parent::__construct($connection,self::SEARCH_CALL_NAME, $this->parameters);
  }


}