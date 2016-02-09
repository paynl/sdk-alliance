<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = \Paynl\Alliance\Merchant::add(
        array(
            // Required
            'companyName' => 'allianceAddTest',
            'cocNumber' => '54212455',
            'street' => 'Kopersteden',
            'houseNumber' => '10',
            'postalCode' => '7547 TK',
            'city' => 'Enschede',
            'accounts' => array(
                // Minimum of 1 account, you can add more, one account must be primary, the other accounts cannot be primary
                array(
                    'primary' => true,
                    // One account must be primary
                    'email' => 'email@test.nl',
                    'firstname' => 'Andy',
                    'lastname' => 'Pieters',
                    'gender' => 'male',
                    'authorisedToSign' => 2,
                    //0 not authorised, 1 authorised independently, 2  shared authorized to sign
                    'ubo' => true,
                    // Ultimate beneficial owner (25% of more shares)
                ),
                array(
                    'primary' => false,
                    'email' => 'email2@test.nl',
                    'firstname' => 'Mede',
                    'lastname' => 'Eigenaar',
                    'gender' => 'female',
                    'authorisedToSign' => 2,
                    //0 not authorised, 1 authorised independently, 2  shared authorized to sign
                    'ubo' => true,
                    // Ultimate beneficial owner (25% of more shares)
                ),
                array(
                    'primary' => false,
                    'email' => 'email4@test.nl',
                    'firstname' => 'Mede',
                    'lastname' => 'Eigenaar',
                    'gender' => 'female',
                    'authorisedToSign' => 2,
                    //0 not authorised, 1 authorised independently, 2  shared authorized to sign
                    'ubo' => true,
                    // Ultimate beneficial owner (25% of more shares)
                ),
            ),

            // Optional

            /*
             * So you want to send a registration email to the accounts.
             * The options are:
             * 0 - No email is sent
             * 1 - The default registration email is sent
             * 2 - The shortened alliance registration email is sent
             */
            'sendEmail' => 1, // see above
            'countryCode' => 'NL',
            'bankAccountOwner' => 'Andy Pieters',
            'bankAccountNumber' => 'NL91ABNA0417164300',
            'bankAccountBIC' => 'ABNANL2A',
            'vatNumber' => 'NL123412413',
            'packageName' => 'Alliance', // Alliance or AlliancePlus

            /*
             * Set to true if you want to be able to add a debit invoice to the account of this merchant.
             * Your invoice will be subtracted from the merchants account.
             * You will need to ask the merchant for permission before you can set this value to true
             */
            'settleBalance' => false, // see above
            'payoutInterval' => 'week' //day, week or month
        )
    );

    echo $result->getMerchantId();
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
