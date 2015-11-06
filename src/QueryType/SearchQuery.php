<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/4/15
 * Time: 17:30
 */

namespace CventQuery\QueryType;

use CventQuery\CventConnection;
use CventQuery\CventObject\EventCventObject;


/**
 * File: SearchQuery.php
 * Author: goce
 * Created:  2015.11.04
 *
 * Description:
 */
class SearchQuery extends BaseQuery {

  const SEARCH_CALL_NAME = "Search";

  public function __construct(CventConnection $connection){
    parent::__construct($connection,self::SEARCH_CALL_NAME);

  }

  public function where($paramName,$value,$operator) {
    parent::where($paramName,$value,$operator);
  }

}