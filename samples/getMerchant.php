<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $merchant = Paynl\Alliance\Merchant::get(array(
        # Required
        'merchantId' => 'M-1234-5678'
    ));

    # documents that still need to be uploaded
    $documents = $merchant->getMissingDocuments();
    foreach ($documents as $document) {
        var_dump($document);
    }

    $data = $merchant->getData();

    var_dump($data);
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
