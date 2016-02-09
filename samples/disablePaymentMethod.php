<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $success = Paynl\Alliance\Service::disablePaymentMethod(array(
        'serviceId' => 'SL-2820-5610',
        'paymentMethodId' => 739
    ));
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}

