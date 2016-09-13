<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 19:34
 */

namespace Paynl\Alliance\Api;


use Paynl\Error;
use Paynl\Error\Required;

class Statistics extends Api
{
    public $filters = array();
    protected $version = 5;
    protected $apiTokenRequired = true;
    /**
     * @var \DateTime
     */
    private $startDate;
    /**
     * @var \DateTime
     */
    private $endDate;
    private $validOperators = array(
        'eq', 'neq', 'gt', 'lt', 'like'
    );

    public function addFilter($key, $value, $operator = 'eq')
    {
        if (!in_array($operator, $this->validOperators)) {
            throw new Error\Error('Invalid operator: ' . $operator . '. valid operators are: ' . implode(', ', $this->validOperators));
        }

        $filter = array(
            'key' => $key,
            'operator' => $operator,
            'value' => $value
        );
        array_push($this->filters, $filter);
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate)
    {
        $this->endDate = $endDate;
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('Statistics/management');
    }

    protected function getData()
    {
        $this->data['groupBy'] = array(
            'company_id',
            'payment_profile_id'
        );

        if (!isset($this->startDate)) {
            throw new Required('startDate');
        } else {
            $this->data['startDate'] = $this->startDate->format('Y-m-d');
        }

        if (!isset($this->endDate)) {
            throw new Required('endDate');
        } else {
            $this->data['endDate'] = $this->endDate->format('Y-m-d');
        }

        if (!empty($this->filters)) {
            $filters = $this->makeFilter($this->filters);
            $this->data['filterType'] = $filters['filterType'];
            $this->data['filterOperator'] = $filters['filterOperator'];
            $this->data['filterValue'] = $filters['filterValue'];
        }

        return parent::getData();
    }

    private function makeFilter($normalFiter)
    {
        $arrFilter = array(
            'filterType' => array(),
            'filterOperator' => array(),
            'filterValue' => array()
        );

        $i = 0;
        foreach ($normalFiter as $filter) {
            $arrFilter['filterType'][$i] = $filter['key'];
            $arrFilter['filterOperator'][$i] = $filter['operator'];
            $arrFilter['filterValue'][$i] = $filter['value'];
            $i++;
        }

        return $arrFilter;
    }

    protected function processResult($result)
    {
        $output = \Paynl\Helper::objectToArray($result);

        if (!is_array($output)) {
            throw new Error\Api($output);
        }

        return $output;
    }
}