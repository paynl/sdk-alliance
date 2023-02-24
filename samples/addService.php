<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = Paynl\Alliance\Service::add(
        array(
            # Required
            'merchantId' => 'M-1234-5678',
            'name' => 'My New Service', # The name of the service
            'description' => 'My New Service description', # Description of the service. It is important to be as acurate as possible.
            'categoryId' => 'CY-2010-6000', # See https://admin.pay.nl/data/categories for a list of available category-codes
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
                    'id' => 2561, # Riverty
                    'settings' => array(
                        'merchantId' => 1234,
                        'merchantPassword' => 'merchantPassword',
                        'portefeuilleId' => '1'
                    )
                )

            ),
            'publication' => 'https://www.pay.nl', # Description of the way you are using the payment methods

            # Optional            
            'publicationUrls' => array(
                'https://www.shop1.pay.nl',
                'https://www.shop2.pay.nl'
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
            ),
            // 'pluginVersionId' => 'PV-1234-5678', # The scrambled plugin version ID which has the following format: PV-0000-0000            
            // 'contactPhone' => '1234567890', # A phone number that customers can use to contact the merchant
        )
    );

    var_dump($result->getServiceId());
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
