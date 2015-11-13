<?php
/**
 * Created by PhpStorm.
 * User: goce
 * Date: 11/3/15
 * Time: 17:35
 */

namespace CventQuery;

use CventQuery\CventConnection;
use CventQuery\CventObject\CventObjectInterface;
use CventQuery\QueryType\QueryTypeInterface;
use CventQuery\CallType\SearchCall;
use CventQuery\CallType\RetrieveCall;


/**
 * File: Cvent.php
 * Author: goce
 * Created:  2015.11.03
 *
 */
class CventQuery {

  /**
   * @var CventObjectInterface
   */
  private $cventObject;

  /**
   * @var SearchCall
   */
  private $search;

  /**
   * @var RetrieveCall
   */
  private $retrieve;

  /**
   * @var CventConnection
   */
  protected $connection;

  /**
   * CventQuery constructor.
   *
   * @param \CventQuery\CventConnection                  $connection
   * @param \CventQuery\CventObject\CventObjectInterface $cventObject
   */
  public function __construct(CventConnection $connection, CventObjectInterface $cventObject) {

    $this->search = new SearchCall($cventObject);
    $this->retrieve = new RetrieveCall($cventObject);

    $this->connection = $connection;
    $this->cventObject = $cventObject;
  }


  public function get() {
    $results = [];
    $search = $this->getSearchQueryResults();

    $temp = $this->getRetrieveQueryResults($search);

    return $temp;
  }

  public function where($paramName,$value,$operator="")
  {
    if(empty($operator)){
      $operator = SearchOperator::EQUALS;
    }

    $this->search->setFilter($paramName,$value,$operator);

    return $this;
  }

  /**
   * @return array
   */
  private function getSearchQueryResults(){
    $searchResults = $this->connection->request($this->search->method(),$this->search->data());

    $results = [];

    if(isset($searchResults->SearchResult->Id)){
      $results = $searchResults->SearchResult->Id;
    }

    return $results;
  }

  private function getRetrieveQueryResults(array $Ids)
  {
    $results = [];

    $retrieveResults = $this->connection->request($this->retrieve->method(),$this->retrieve->whereIds($Ids)->data());

    if(!empty($retrieveResults->RetrieveResult->CvObject)){
      $results = $retrieveResults->RetrieveResult->CvObject;
    }

    return $results;
  }



}