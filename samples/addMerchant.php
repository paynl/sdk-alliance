<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $result = \Paynl\Alliance\Merchant::add(
        array(
            #  Required
            'companyName' => 'subMerchantName',
            'cocNumber' => '54292456',
            'street' => 'streetName',
            'houseNumber' => '10',
            'postalCode' => '1000 AA',
            'city' => 'City',
            'countryCode' => 'NL', # Available countries: AT, BE, BG, CY, DE, DK, EE, ES, FI, FR, GB, GR, HR, HU, IE, IT, LT, LU, MT, NL, NO, PL, PT, RO, SE & SK                     
            'accounts' => array(
                # Atleast 1 account is required. You can add more then one. One account must be primary, the other accounts cannot be primary
                array(
                    'email' => 'email@test.nl',
                    'firstname' => 'Firstname',
                    'lastname' => 'Lastname',
                    'gender' => 'male',
                    'authorisedToSign' => 2, # 0 = Not authorised, 1 = Authorised independently, 2 = Shared authority to sign
                    'placeOfBirth' => 'City', 
                    'dateOfBirth' => '09-09-1999', # The date of birth in the following format: d-m-Y
                    'ubo' => 50, # Percentage of shares
                    'hasAccess' => true, # Allow access to the PAY. admin panel
                     # 'language' => 'nl', # available languages: NL, FR, EN, FL, DE
                    'useCompanyAuth' => true # Set to true to grant full company rights
                ),
                array(
                    'email' => 'email2@test.nl',
                    'firstname' => 'Co',
                    'lastname' => 'Owner',
                    'gender' => 'female',
                    'authorisedToSign' => 2, # 0 = Not authorised, 1 = Authorised independently, 2 = Shared authority to sign
                    'placeOfBirth' => 'City', 
                    'dateOfBirth' => '09-09-1999', # The date of birth in the following format: d-m-Y
                    'ubo' => 25, # Percentage of shares
                    'hasAccess' => true,
                     # 'language' => 'en',
                    'useCompanyAuth' => false # All company rights
                ),
                array(
                    'email' => 'email4@test.nl',
                    'firstname' => 'Co',
                    'lastname' => 'Owner1',
                    'gender' => 'female',
                    'authorisedToSign' => 2,  # 0 = Not authorised, 1 = Authorised independently, 2 = Shared authority to sign
                    'placeOfBirth' => 'City', 
                    'dateOfBirth' => '09-09-1999', # The date of birth in the following format: d-m-Y
                    'ubo' => 25, # Percentage of shares
                    'hasAccess' => false,
                     # 'language' => 'de',
                    'useCompanyAuth' => false # All company rights
                ),
                array(
                    'email' => 'email5@test.nl',
                    'firstname' => 'Co',
                    'lastname' => 'Owner2',
                    'gender' => 'female',
                    'authorisedToSign' => 0,  # 0 = Not authorised, 1 = Authorised independently, 2 = Shared authority to sign
                    'placeOfBirth' => 'City', 
                    'dateOfBirth' => '09-09-1999', # The date of birth in the following format: d-m-Y
                    'ubo' => false, # Percentage of shares
                    'hasAccess'=> true,
                     # 'language' => 'de',
                    'useCompanyAuth' => false # All company rights
                ),
            ),

            #  Optional

            /*
             * So you want to send a registration email to the accounts.
             * The options are:
             * 0 - No email is sent at all
             * 1 - The default registration email is sent with a brief introduction about the partnership
             * 2 - The shortened alliance registration email is sent with just login credentials
             */
            'sendEmail' => 1,
            'bankAccountOwner' => 'Firstname Lastname',
            'bankAccountNumber' => 'NL91ABNA0417164300',
            'bankAccountBIC' => 'ABNANL2A',
             # 'vatNumber' => 'NL807960147B01', # Optional, as there is no VAT relation between Pay.nl and submerchant
            'packageName' => 'Alliance', #  Alliance or AlliancePlus
             # 'referralProfileId' => 'CP-1234-1234', #  Allows Pay.nl to load settings of company. Only use this if you have
                                                      #  been provided a code by pay.nl


            /*
             * Set to true if you want to be able to debit the balance of this merchant.
             * Your invoice may be subtracted from the merchants balance via the Alliance:addInvoice API.
             * You need to ask the Merchant permission before setting this value to true
             * This also adds an extra line in the generated contract, granting permission to access the balance
             * and granting access to the Submerchant's account and statistics
             */
            'settleBalance' => true,
            'payoutInterval' => 'week' # Options are: day, week, month or manual by using merchant::addClearing API
        )
    );

    echo $result->getMerchantId();
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
