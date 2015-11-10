<?php namespace CventQuery\CallType;

use CventQuery\CventObject\CventObjectInterface;

/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/10/15
 * Time: 11:42
 *
 * Responsible for running a SearchCall against cvent's soap apis
 *
 *
 */

class SearchCall extends BaseCall {

  const SEARCH_CALL_NAME = "Search";

  public function __construct(\CventQuery\CventConnection $connection, $data) {

    parent::__construct($connection, self::SEARCH_CALL_NAME, $data);

  }

}