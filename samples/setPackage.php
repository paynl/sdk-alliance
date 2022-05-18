<?php
require_once '../vendor/autoload.php';

require_once 'config.php';

try {
    if (\Paynl\Alliance\Merchant::setPackage(array(
        # Required
        'merchantId' => 'M-1234-5678', # The id of the merchant
        'package' => 'ALLIANCE' # The package to change to. Possible options are: ALLIANCE, ALLIANCEPLUS
    ))) {
        echo 'Package has been changed.';
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
