<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/4/15
 * Time: 17:30
 */

namespace CventQuery\QueryType;

use CventQuery\CventConnection;


/**
 * File: SearchQuery.php
 * Author: goce
 * Created:  2015.11.04
 *
 * Description:
 */
class SearchQuery extends BaseQuery {

  public function __construct(CventConnection $connection){
    parent::__construct($connection, "Search");
  }

}