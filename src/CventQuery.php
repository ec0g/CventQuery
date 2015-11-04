<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/3/15
 * Time: 17:35
 */

namespace CventQuery;

use CventQuery\CventConnection;

/**
 * File: Cvent.php
 * Author: goce
 * Created:  2015.11.03
 *
 */
class CventQuery {

  private $cventConnect;

  public function __construct(CventConnection $connection) {

    $this->cventConnect = $connection;
  }


}