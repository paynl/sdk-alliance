<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = Paynl\Alliance\Merchant::getList(array('state' => 'accepted'));

    $merchants = $result->getMerchants();

    foreach ($merchants as $merchant) {
        echo $merchant->getMerchantId() . ' ' . $merchant->getMerchantName() . "<br />";
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}