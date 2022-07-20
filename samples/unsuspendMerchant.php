<?php
require_once '../vendor/autoload.php';

require_once 'config.php';

try {
    if (\Paynl\Alliance\Merchant::unsuspend(array(
        # Required
        'merchantId' => 'M-1234-5678' /*The id of the merchant*/
    ))) {
        echo 'Merchant has been unsuspended.';
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
