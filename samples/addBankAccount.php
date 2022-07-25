<?php
require_once '../vendor/autoload.php';

require_once 'config.php';

$issuerUrl = \Paynl\Alliance\Merchant::addBankAccount(array(
    # Required
    'merchantId' => 'M-1234-5678', #The id of the merchant
    'returnUrl' => 'http://www.youradmin.com', #After payment we redirect to this url

    # Optional
    'bankId' => 1, # The ideal bankid use \Paynl\Paymentmethods::getBanks() to get the list of banks
    'paymentOptionId' => 10 # The ID of the payment profile (standard iDEAL)
));


echo $issuerUrl; # redirect the user to this url to complete the payment, the bankaccount will automaticly be linked to the merchant account