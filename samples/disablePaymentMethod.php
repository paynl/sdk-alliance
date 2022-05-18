<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $success = Paynl\Alliance\Service::disablePaymentMethod(array(
        # Required
        'serviceId' => 'SL-1234-5678',
        'paymentMethodId' => 739
    ));

    if ($success) {
        // disabling succeeded
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
