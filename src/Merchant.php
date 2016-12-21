<?php


namespace Paynl\Alliance;

use Paynl\Error\Error;
use Paynl\Error\Required;

class Merchant
{

    /**
     * Add a merchant
     *
     * Create a new submerchant.
     * The format of the option array is as follows
     * array(
     *      // Required
     *      'companyName' => 'The Name',
     *      'cocNumber' => '123456789',
     *      'street' => 'Street',
     *      'houseNumber' => '123',
     *      'postalCode' => '1234 AA',
     *      'city' => 'City',
     *      'accounts' => array(
     *          // Minimum of 1 account, you can add more, one account must be primary, the other accounts cannot be primary
     *          array(
     *              'primary' => true, // One account must be primary
     *              'email' => 'email@test.nl',
     *              'firstname' => 'First',
     *              'lastname' => 'Last',
     *              'gender' => 'male', // 'male' or 'female'
     *              'authorisedToSign' => 2, //0 not authorised, 1 authorised independently, 2  shared authorized to sign
     *              'ubo' => true, // Ultimate beneficial owner (25% of more shares)
     *          ),
     *          array(
     *              'primary' => false,
     *              'email' => 'email2@test.nl',
     *              'firstname' => 'Mede',
     *              'lastname' => 'Eigenaar',
     *              'gender' => 'female', // 'male' or 'female'
     *              'authorisedToSign' => 2, //0 not authorised, 1 authorised independently, 2  shared authorized to sign
     *              'ubo' => true, // Ultimate beneficial owner (25% of more shares)
     *          )
     *       ),
     *      // Optional
     *      Do you want to send a registration email to the accounts.
     *      The options are:
     *      0 - No email is sent
     *      1 - The default registration email is sent
     *      2 - The shortened alliance registration email is sent
     *      'sendEmail' => 1, // see above
     *      'countryCode' => 'NL',
     *      'bankAccountOwner' => 'Firstname Lastname',
     *      'bankAccountNumber' => 'NL91ABNA0417164300',
     *      'bankAccountBIC' => 'ABNANL2A',
     *      'vatNumber' => 'NL123412413',
     *      'packageName' => 'Alliance', // Alliance or AlliancePlus
     *
     *      Set to true if you want to be able to add a debit invoice to the account of this merchant.
     *      Your invoice will be subtracted from the merchants account.
     *      You will need to ask the merchant for permission before you can set this value to true
     *      'settleBalance' => false, // see above
     *      'payoutInterval' => 'week' //day, week or month
     *  )
     *
     * @param array $options see Description
     * @return Result\Merchant\Add
     * @throws Error
     * @throws Required
     */
    public static function add($options)
    {
        $api = new Api\AddMerchant();

        if (isset($options['accounts'])) {
            self::_addAccounts($options['accounts'], $api);
        }

        if (isset($options['companyName'])) {
            $api->setCompanyName($options['companyName']);
        }
        if (isset($options['cocNumber'])) {
            $api->setCocNumber($options['cocNumber']);
        }
        if (isset($options['street'])) {
            $api->setStreet($options['street']);
        }
        if (isset($options['houseNumber'])) {
            $api->setHouseNumber($options['houseNumber']);
        }
        if (isset($options['postalCode'])) {
            $api->setPostalCode($options['postalCode']);
        }
        if (isset($options['city'])) {
            $api->setCity($options['city']);
        }
        if (isset($options['sendEmail'])) {
            $api->setSendEmail($options['sendEmail']);
        }
        if (isset($options['countryCode'])) {
            $api->setCountryCode($options['countryCode']);
        }
        if (isset($options['bankAccountOwner'])) {
            $api->setBankAccountOwner($options['bankAccountOwner']);
        }
        if (isset($options['bankAccountNumber'])) {
            $api->setBankAccountNumber($options['bankAccountNumber']);
        }
        if (isset($options['bankAccountBIC'])) {
            $api->setBankAccountBic($options['bankAccountBIC']);
        }
        if (isset($options['packageName'])) {
            $api->setPackageName($options['packageName']);
        }
        if (isset($options['settleBalance'])) {
            $api->setSettleBalance($options['settleBalance']);
        }
        if(isset($options['referralProfileId'])){
            $api->setReferralProfileId($options['referralProfileId']);
        }
        if (isset($options['payoutInterval'])) {
            $api->setInvoiceInterval($options['payoutInterval']);
        }
        $result = $api->doRequest();

        return new Result\Merchant\Add($result);
    }

    /**
     * Add the accounts to the addMerchant API
     *
     * @param array $accounts
     * @param Api\AddMerchant $api
     * @throws Error
     * @throws Required
     */
    private static function _addAccounts(array $accounts, Api\AddMerchant $api)
    {
        if (count($accounts) == 0) {
            throw new Required('accounts');
        }
        $primaryAccount = null;
        $signees = array();
        if (count($accounts) == 1) {
            $primaryAccount = array_pop($accounts);
        } else {
            foreach ($accounts as $account) {
                if ($account['primary']) {
                    if (!is_null($primaryAccount)) {
                        throw new Error('You can only add 1 primary account');
                    }
                    $primaryAccount = $account;
                } else {
                    array_push($signees, $account);
                }
            }
        }
        if (is_null($primaryAccount)) {
            throw new Error('One account must be the primary account');
        }
        if (isset($primaryAccount['email'])) {
            $api->setEmail($primaryAccount['email']);
        }
        if (isset($primaryAccount['firstname'])) {
            $api->setFirstName($primaryAccount['firstname']);
        }
        if (isset($primaryAccount['lastname'])) {
            $api->setLastName($primaryAccount['lastname']);
        }
        if (isset($primaryAccount['gender'])) {
            $api->setGender($primaryAccount['gender']);
        }
        if (isset($primaryAccount['authorisedToSign'])) {
            $api->setAuthorisedToSign($primaryAccount['authorisedToSign']);
        }
        if (isset($primaryAccount['ubo'])) {
            $api->setUbo($primaryAccount['ubo']);
        }
        if (!empty($signees)) {
            foreach ($signees as $signee) {
                if (empty($signee['email'])) {
                    throw new Required('account - email');
                }
                if (empty($signee['firstname'])) {
                    throw new Required('account - firstname');
                }
                if (empty($signee['lastname'])) {
                    throw new Required('account - lastname');
                }
                if (empty($signee['gender'])) {
                    throw new Required('account - gender');
                }
                if (empty($signee['authorisedToSign'])) {
                    $signee['authorisedToSign'] = 0;
                }
                if (empty($signee['ubo'])) {
                    $signee['ubo'] = 0;
                }
                $api->addSignee($signee['email'], $signee['firstname'], $signee['lastname'],
                    $signee['authorisedToSign'], $signee['ubo']);
            }
        }
    }

    /**
     * @param $options
     * @return Result\Merchant\Get
     */
    public static function get($options)
    {
        $api = new Api\GetMerchant();
        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }

        $result = $api->doRequest();

        return new Result\Merchant\Get($result);
    }

    public static function getList($options = array())
    {
        $api = new Api\GetMerchants();

        if (isset($options['state'])) {
            $api->setState($options['state']);
        }

        $result = $api->doRequest();

        return new Result\Merchant\GetList($result);
    }

}