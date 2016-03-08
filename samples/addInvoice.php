<?php
require_once '../vendor/autoload.php';
require_once('config.php');

// don't forget to set the serviceId
// This is your service, where the transaction will be added to
\Paynl\Config::setServiceId('SL-1234-1234');

try {
    $result = Paynl\Alliance\Invoice::add(array(
        // Required
        'merchantId' => 'M-1234-1234', // the id of the merchant
        'invoiceId' => 'INV012345', // Your reference number to the invoice
        'amount' => 25.75, // The total amount of the invoice
        'description' => 'Test invoice', // The description of the invoice

        // Optional
        'invoiceUrl' => 'http://url.to.the/invoice.pdf', // the url to the invoice
        'makeYesterday' => true // if the invoice needs to be added in today's clearing, set this to true
    ));

    echo $result->referenceId();

} catch (\Exception $e){
    echo "Error occurred: ".$e->getMessage();
}