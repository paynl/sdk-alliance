<?php
require_once '../vendor/autoload.php';

require_once 'config.php';

$issuerUrl = \Paynl\Alliance\Merchant::addBankAccount(array(
    'merchantId' => 'M-1234-5678', //The id of the merchant
    'returnUrl' => 'http://www.youradmin.com', //After payment we redirect to this url
    'bankId' => 1, // optional, the ideal bankid use \Paynl\Paymentmethods::getBanks() to get the list of banks
    'paymentOptionId' => 10 // optional, the ID of the payment profile (standard iDEAL)
));


echo $issuerUrl; // redirect the user to this url to complete the payment, the bankaccount will automaticly be linked to the merchant account