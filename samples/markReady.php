<?php
require_once '../vendor/autoload.php';

require_once 'config.php';

try {
    if (\Paynl\Alliance\Merchant::markReady(array('merchantId' => 'M-1234-5678' /*The id of the merchant*/)) === true) {
        echo 'Merchant has been marked as "ready".';
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}