<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $success = Paynl\Alliance\Service::enablePaymentMethod(array(
        # Required
        'serviceId' => 'SL-1234-5678',
        'paymentMethodId' => 739,

        # Optional
        'settings' => array(
            'merchantId' => 1234,
            'merchantPassword' => 'p4ssw0rd',
            'portefeuilleId' => '2'
        )
    ));

    if ($success) {
        // enabling succeeded
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
