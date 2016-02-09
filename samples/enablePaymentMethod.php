<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {

    $success = Paynl\Alliance\Service::enablePaymentMethod(array(
        'serviceId' => 'SL-2820-5610',
        'paymentMethodId' => 739,
        'settings' => array(
            'merchantId' => 1234,
            'merchantPassword' => 'p4ssw0rd',
            'portefeuilleId' => '2'
        )
    ));

    if($success){
        // enabling succeeded
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}

