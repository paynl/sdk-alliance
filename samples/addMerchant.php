<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = \Paynl\Alliance\Merchant::add(
        array(
            // Required
            'companyName' => 'allianceAddTest',
            'cocNumber' => '54212457',
            'street' => 'Kopersteden',
            'houseNumber' => '10',
            'postalCode' => '7547 TK',
            'city' => 'Enschede',
            'countryCode' => 'NL', // Available countries: NL, BE, LU, FR, UK, DK, ES, DE, IT, GR
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
                    //0 not authorised, 1 authorised independently, 2  shared authority to sign
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
                    //0 not authorised, 1 authorised independently, 2  shared authority to sign
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
                    //0 not authorised, 1 authorised independently, 2 shared authority to sign
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

//            'referralProfileId' => 'CP-1234-1234', // Only use this if you know what it is


            /*
             * Set to true if you want to be able to debit the balance of this merchant.
             * Your invoice may be subtracted from the merchants balance via the Alliance:addInvoice API.
             * You need to ask the Merchant permission before setting this value to true
             * This also adds an extra line in the generated contract, granting permission to access the balance
             * and granting access to the Submerchant's account and statistics
             */
            'settleBalance' => false, // see above
            'payoutInterval' => 'week' //day, week or month
        )
    );

    echo $result->getMerchantId();
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
