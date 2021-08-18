<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = Paynl\Alliance\Service::add(array(
        'merchantId' => 'M-1234-1234',
        'name' => 'My New Service',
        'description' => 'My New Service description',
        'categoryId' => 'CY-0000-0000', # See https://admin.pay.nl/data/categories for a list of available category-codes
        'url' => 'https://www.pay.nl',
        'extraUrls' => array(
            'https://www.shop1.pay.nl',
            'https://www.shop2.pay.nl'
        ),
        /**
         * You can select the payment options that need to be enabled.
         * If you don't supply any payment methods, all available payment methods will be enabled
         */
        'paymentOptions' => array(
            array(
                'id' => 10, # iDEAL Payment Method
                'settings' => array(
                    # iDEAL doesn't have settings
                ),
            ),
            array(
                'id' => 739, # AfterPay
                'settings' => array(
                    'merchantId' => 1234,
                    'merchantPassword' => 'merchantPassword',
                    'portefeuilleId' => '1'
                )
            )

        ),
        'exchange' => array(
            /**
             * 0 no exchange
             * 1 define urls here
             * 2 url is supplied with the transaction start call
             */
            'useExchange' => 1,

            /**
             * 0 only on succesfull transaction
             * 1 all status changes
             */
            'alwaysSendExchange' => 1,

            /**
             * GET or POST
             */
            'requestMethod' => 'POST',
            /**
             * Your response should start with TRUE
             * Then your seperator, and then your message
             */
            'resultSeperator' => '|',
            /**
             * 0 - no retry
             * 1 - retry 10 times in 24 hours
             * 4 - 1 time after 5 seconds
             * 7 - 6 times (in 2 hours)
             * 10 - every 15 minutes for 2 hours
             */
            'retry' => 4,

            'urls' => array(
                'https://www.pay.nl/ex',
                'https://www.pay.nl/ex2',
            )
        )
    ));

    var_dump($result->getServiceId());

} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
