<?php
require_once '../vendor/autoload.php';

require_once 'config.php';

try {
    if (\Paynl\Alliance\Merchant::addClearing(
        array(
            'amount' => '123', /*(Required) The amount to clear, in cents.*/
            'merchantId' => 'M-1234-5678', /*(Optional) The id of the merchant*/
            'contentCategoryId' => 'CT-1234-5678' /*(Optional) The content category Id.*/
        )
    ) === true) {
        echo 'Amount has been Cleared.';
    }
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
