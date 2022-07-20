<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $methods = Paynl\Alliance\Service::getAvailablePaymentMethods([
        'serviceId' => 'SL-1234-5678',
    ]);

    var_dump($methods);
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
