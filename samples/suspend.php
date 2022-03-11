<?php
require_once '../vendor/autoload.php';

require_once 'config.php';

try {
    if (\Paynl\Alliance\Merchant::suspend(array('merchantId' => 'M-4236-6241' /*The id of the merchant*/))) {
        echo 'Merchent has been suspended.';
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}