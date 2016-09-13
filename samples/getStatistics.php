<?php
require_once '../vendor/autoload.php';
require_once('config.php');

try {
    /**
     * You can either call the getStats with a period, or startDate and endDate
     *
     * for example:
     * 'startDate' => new DateTime('2015-03-01'),
     * 'endDate' => new DateTime('2015-03-08')
     *
     * Or
     * 'period' => \Paynl\Alliance\Statistics::PERIOD_LAST_WEEK
     *
     * Usable periods:
     * \Paynl\Alliance\Statistics::PERIOD_THIS_WEEK
     * \Paynl\Alliance\Statistics::PERIOD_LAST_WEEK
     * \Paynl\Alliance\Statistics::PERIOD_THIS_MONTH
     * \Paynl\Alliance\Statistics::PERIOD_LAST_MONTH
     */
    $result = Paynl\Alliance\Statistics::getStats(array(
        'period' => \Paynl\Alliance\Statistics::PERIOD_THIS_WEEK,

        'excludeSandbox' => true,

        'filters' => array(
            array(
                'key' => 'payment_profile_id',
                'value' => '10',
                'operator' => 'eq' // possible values are: 'eq', 'neq', 'gt', 'lt', 'like'
            ),
        ),
    ));

    $data = $result->getData();

    var_dump($data);
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}