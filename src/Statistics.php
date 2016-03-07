<?php

namespace Paynl\Alliance;

use Paynl\Error\Error;

class Statistics
{
    const PERIOD_THIS_WEEK = 1;
    const PERIOD_LAST_WEEK = 2;
    const PERIOD_THIS_MONTH = 3;
    const PERIOD_LAST_MONTH = 4;

    public static function getStats($options = array())
    {
        $api = new Api\Statistics();

        if(isset($options['period'])){
            $period = self::getPeriod($options['period']);
            $api->setStartDate($period[0]);
            $api->setEndDate($period[1]);
        }

        if(isset($options['startDate'])){
            $api->setStartDate($options['startDate']);
        }
        if(isset($options['endDate'])){
            $api->setEndDate($options['endDate']);
        }
        $result = $api->doRequest();

        $data = new Result\Statistics\getStats($result);

        return $data;
    }


    private static function getPeriod($period)
    {
        $startDate = null;
        $endDate = null;
        switch ($period) {
            case self::PERIOD_THIS_WEEK:
                $startDate = new \DateTime('monday this week');
                $endDate = new \DateTime('now');
                break;
            case self::PERIOD_LAST_WEEK:
                $startDate = new \DateTime('monday last week');
                $endDate = new \DateTime('sunday last week');
                break;
            case self::PERIOD_THIS_MONTH:
                $startDate = new \DateTime('first day of this month');
                $endDate = new \DateTime('now');
                break;
            case self::PERIOD_LAST_MONTH:
                $startDate = new \DateTime('first day of last month');
                $endDate = new \DateTime('last day of last month');
                break;
            default:
                throw new Error('Invalid period');
                break;
        }
        return array(
            $startDate, $endDate
        );
    }
}