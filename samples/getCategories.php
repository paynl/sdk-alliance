<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $categories = Paynl\Alliance\Service::getCategories(array(
        # Optional
        'paymentOptionId' => 10, # The ID of the payment profile
    ));
    $data = $categories->getData();

    var_dump($data);
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
