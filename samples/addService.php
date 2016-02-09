<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = Paynl\Alliance\Service::add(array(
        'merchantId' => 'M-1820-9300',
        'name' => 'Andy Test',
        'description' => 'Andy Test Add service By Api',
        'categoryId' => 9,// use Paynl\Alliance\Service::getCategories() to get the list of available categories
        'url' => 'http://www.pay.nl',
        'extraUrls' => array(
            'http://www.admin.pay.nl',
            'http://www.shop.pay.nl'
        ),
        'alwaysSendExchange' => true
    ));

    var_dump($result->getServiceId());
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}