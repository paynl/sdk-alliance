<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = \Paynl\Alliance\Merchant::add(
        array(
            // Required
            'companyName' => 'Addv3Test',
            'cocNumber' => '54292456',
            'street' => 'Kopersteden',
            'houseNumber' => '10',
            'postalCode' => '7547 TK',
            'city' => 'Enschede',
            'countryCode' => 'NL', // Available countries: AT, BE, BG, CY, DE, DK, EE, ES, FI, FR, GB, GR, HR, HU, IE, IT,
                                   //                      LT, LU, MT, NL, NO, PL, PT, RO, SE & SK                     
            'accounts' => array(
                // Minimum of 1 account. you can add more, one account must be primary, the other accounts cannot be primary
                array(
                    'email' => 'email@test.nl',
                    'firstname' => 'Andy',
                    'lastname' => 'Pieters',
                    'gender' => 'male',
                    'authorisedToSign' => 2,
                    //0 not authorised, 1 authorised independently, 2  shared authority to sign
                    'ubo' => 50, //percentage of shares
                    'hasAccess'=> true, //allow access to the pay.nl admin panel
//                    'language' => 'nl', //available languages: NL, FR, EN, FL, DE
                    'useCompanyAuth' => true // set to true to grant full company rights
                ),
                array(
                    'email' => 'email2@test.nl',
                    'firstname' => 'Co',
                    'lastname' => 'Owner',
                    'gender' => 'female',
                    'authorisedToSign' => 2,
                    //0 not authorised, 1 authorised independently, 2  shared authority to sign
                    'ubo' => 25, //percentage of shares
                    'hasAccess'=> true,
//                    'language' => 'en',
                    'useCompanyAuth' => false // All company rights
                ),
                array(
                    'email' => 'email4@test.nl',
                    'firstname' => 'Co',
                    'lastname' => 'Owner1',
                    'gender' => 'female',
                    'authorisedToSign' => 2,
                    //0 not authorised, 1 authorised independently, 2 shared authority to sign
                    'ubo' => 25, //percentage of shares
                    'hasAccess'=> false, //
//                    'language' => 'de',
                    'useCompanyAuth' => false // All company rights
                ),
                array(
                    'email' => 'email5@test.nl',
                    'firstname' => 'Co',
                    'lastname' => 'Owner2',
                    'gender' => 'female',
                    'authorisedToSign' => 0,
                    //0 not authorised, 1 authorised independently, 2 shared authority to sign
                    'ubo' => false, //percentage of shares
                    'hasAccess'=> true,
//                    'language' => 'de',
                    'useCompanyAuth' => false // All company rights
                ),
            ),

            // Optional

            /*
             * So you want to send a registration email to the accounts.
             * The options are:
             * 0 - No email is sent at all
             * 1 - The default registration email is sent with a brief introduction about the partnership
             * 2 - The shortened alliance registration email is sent with just login credentials
             */
            'sendEmail' => 1, // see above
            'bankAccountOwner' => 'Andy Pieters',
            'bankAccountNumber' => 'NL91ABNA0417164300',
            'bankAccountBIC' => 'ABNANL2A',
//            'vatNumber' => 'NL807960147B01', // optional, as there is no VAT relation between Pay.nl and submerchant
            'packageName' => 'Alliance', // Alliance or AlliancePlus

//            'referralProfileId' => 'CP-1234-1234', // Allows Pay.nl to load settings of company. Only use this if you have
                                                     // been provided a code by pay.nl


            /*
             * Set to true if you want to be able to debit the balance of this merchant.
             * Your invoice may be subtracted from the merchants balance via the Alliance:addInvoice API.
             * You need to ask the Merchant permission before setting this value to true
             * This also adds an extra line in the generated contract, granting permission to access the balance
             * and granting access to the Submerchant's account and statistics
             */
            'settleBalance' => true, // see above
            'payoutInterval' => 'week' //day, week, month or manual by using merchant::addClearing API
        )
    );

    echo $result->getMerchantId();
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
