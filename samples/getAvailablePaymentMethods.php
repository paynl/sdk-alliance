<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    
    $methods = Service::getAvailablePaymentMethods([
            'serviceId' => 'YOUR-SERVICE-ID',
    ]);

} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}

