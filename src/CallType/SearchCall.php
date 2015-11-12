<?php namespace CventQuery\CallType;

use CventQuery\CventObject\CventObjectInterface;
use stdClass;

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

  protected $cvSearchObject;

  const OR_SEARCH = 'OrSearch';
  const AND_SEARCH = 'AndSearch';

  private $filters;

  /**
   * SearchCall constructor.
   *
   * @param \CventQuery\CventConnection $connection
   * @param                             $data
   */
  public function __construct(\CventQuery\CventConnection $connection, CventObjectInterface $cventObject) {
    parent::__construct($connection, self::SEARCH_CALL_NAME, $cventObject->type());

    $this->cvSearchObject = new stdClass();
    $this->cvSearchObject->SearchType = self::OR_SEARCH;

    $this->filters = [];
  }

  public function runQuery() {

    $this->prepData();

    return parent::runQuery();
  }

  public function setFilter($field, $value, $operator) {
    $filter = new stdClass();
    $filter->Field = $field;
    $filter->Operator = $operator;
    if (!is_array($value)) {
      $filter->Value = $value;
    }

    $this->filters[] = $filter;
  }


  private function prepData() {
    $this->data->CvSearchObject = $this->cvSearchObject;

    if (!empty($this->filters)) {
      $this->data->CvSearchObject->Filter = $this->filters;
    }

  }
}