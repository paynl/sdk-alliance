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
     *      # Required
     *      'companyName' => 'mechantCompanyName',
     *      'cocNumber' => '123456789',
     *      'street' => 'Street',
     *      'houseNumber' => '2',
     *      'postalCode' => '1234 AA',
     *      'city' => 'City',
     *      'accounts' => array(
     *            # Atleast 1 account is required. You can add more then one. One account must be primary, the other accounts cannot be primary
     *          array(
     *              'primary' => true, # One account must be primary
     *              'email' => 'email@test.nl',
     *              'firstname' => 'Firstname',
     *              'lastname' => 'Lastname',
     *              'gender' => 'male', # 'male' or 'female'
     *              'authorisedToSign' => 2, # 0 = Not authorised, 1 = Authorised independently, 2 = Shared authority to sign
     *              'placeOfBirth' => 'City',
     *              'dateOfBirth' => '09-09-1999', # The date of birth in the following format: d-m-Y
     *              'ubo' => true, #  Ultimate beneficial owner (25% of more shares)
     *          ),
     *          array(
     *              'primary' => false,
     *              'email' => 'email2@test.nl',
     *              'firstname' => 'Mede',
     *              'lastname' => 'Eigenaar',
     *              'gender' => 'female', # 'male' or 'female'
     *              'authorisedToSign' => 2, # 0 = Not authorised, 1 = Authorised independently, 2 = Shared authority to sign
     *              'placeOfBirth' => 'City',
     *              'dateOfBirth' => '09-09-1999', # The date of birth in the following format: d-m-Y
     *              'ubo' => true, # Ultimate beneficial owner (25% of more shares)
     *          )
     *       ),
     *
     *      # Optional
     *      Do you want to send a registration email to the accounts.
     *      The options are:
     *      0 - No email is sent
     *      1 - The default registration email is sent
     *      2 - The shortened alliance registration email is sent
     *      'sendEmail' => 1, # see above
     *      'countryCode' => 'NL',
     *      'bankAccountOwner' => 'Firstname Lastname',
     *      'bankAccountNumber' => 'NL91ABNA0417164300',
     *      'bankAccountBIC' => 'ABNANL2A',
     *      'vatNumber' => 'NL123412413',
     *      'packageName' => 'Alliance', # Alliance or AlliancePlus
     *
     *      Set to true if you want to be able to add a debit invoice to the account of this merchant.
     *      Your invoice will be subtracted from the merchants account.
     *      You will need to ask the merchant for permission before you can set this value to true
     *      'settleBalance' => false, # see above
     *      'payoutInterval' => 'week' # Options: day, week or month
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
        $merchant = self::_getMerchant($options);
        $api->setMerchant($merchant);

        $bankAccount = self::_getBankAccount($options);
        if (!empty($bankAccount)) {
            $api->setBankAccount($bankAccount);
        }

        $settings = self::_getSettings($options);
        if (!empty($settings)) {
            $api->setSettings($settings);
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

        foreach ($accounts as $account) {
            if (!isset($account['email'])) {
                throw new Required('account - email');
            }
            if (!isset($account['firstname'])) {
                throw new Required('account - firstname');
            }
            if (!isset($account['lastname'])) {
                throw new Required('account - lastname');
            }
            if (!isset($account['gender'])) {
                throw new Required('account - gender');
            }

            if (!isset($account['authorizedToSign'])) {
                if (isset($account['authorisedToSign'])) {
                    $account['authorizedToSign'] = $account['authorisedToSign'];
                } else {
                    throw new Required('account - authorizedToSign');
                }
            }

            if (!isset($account['authorizedToSign'])) {
                if (!isset($account['authorisedToSign'])) {
                    throw new Required('account - authorizedToSign');
                }
                $account['authorizedToSign'] = $account['authorisedToSign'];
            }

            if (!isset($account['ubo'])) {
                throw new Required('account - ubo');
            }
            if (!isset($account['uboPercentage'])) {
                if (is_numeric($account['ubo']) && $account['ubo'] > 0 && $account['ubo'] <= 100) {
                    $account['uboPercentage'] = $account['ubo'];
                    $account['ubo'] = true;
                }
            }
            $account['ubo'] = (integer)$account['ubo'];

            if(isset($account['hasAccess'])){
                $account['hasAccess'] = (integer) $account['hasAccess'];
            }
            if(isset($account['useCompanyAuth'])){
                $account['useCompanyAuth'] = (integer) $account['useCompanyAuth'];
            }            

            $api->addAccount($account);

        }
    }

    /**
     * @param array $options
     */
    private static function _getMerchant($options)
    {
        $merchant = array();

        if (!isset($options['companyName'])) {
            throw new Required('companyName');
        }
        $merchant['name'] = $options['companyName'];

        if (!isset($options['cocNumber'])) {
            throw new Required('cocNumber');
        }
        $merchant['coc'] = $options['cocNumber'];

        if (!isset($options['street'])) {
            throw new Required('street');
        }
        $merchant['street'] = $options['street'];

        if (!isset($options['houseNumber'])) {
            throw new Required('houseNumber');
        }
        $merchant['houseNumber'] = $options['houseNumber'];

        if (!isset($options['postalCode'])) {
            throw new Required('postalCode');
        }
        $merchant['postalCode'] = $options['postalCode'];

        if (!isset($options['city'])) {
            throw new Required('city');
        }
        $merchant['city'] = $options['city'];

        if (!isset($options['countryCode'])) {
            throw new Required('countryCode');
        }
        $merchant['countryCode'] = $options['countryCode'];

        /**
         * Optional
         */
        if (isset($options['vatNumber'])) {
            $merchant['vat'] = $options['vatNumber'];
        }
        if (isset($options['houseNumberAddition'])) {
            $merchant['houseNumberAddition'] = $options['houseNumberAddition'];
        }
        return $merchant;
    }

    private static function _getBankAccount($options)
    {
        $bankAccount = array();
        if (isset($options['bankAccountOwner'])) {
            $bankAccount['bankAccountOwner'] = $options['bankAccountOwner'];
        }
        if (isset($options['bankAccountNumber'])) {
            $bankAccount['bankAccountNumber'] = $options['bankAccountNumber'];
        }
        if (isset($options['bankAccountBIC'])) {
            $bankAccount['bankAccountBIC'] = $options['bankAccountBIC'];
        }
        return $bankAccount;
    }

    private static function _getSettings($options)
    {
        $settings = array();

        if (isset($options['packageName'])) {
            $settings['packageName'] = $options['packageName'];
        }
        if (isset($options['packageName'])) {
            $settings['packageName'] = $options['packageName'];
        }

        if (isset($options['sendEmail'])) {
            $settings['sendEmail'] = $options['sendEmail'];
        }
        if (isset($options['settleBalance'])) {
            $settings['settleBalance'] = (integer)$options['settleBalance'];
        }
        if (isset($options['referralProfileId'])) {
            $settings['referralProfileId'] = $options['referralProfileId'];
        }
        if (isset($options['clearingInterval'])) {
            $settings['clearingInterval'] = $options['clearingInterval'];
        }
        return $settings;
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

    /**
     * @param $options
     * @return string
     */
    public static function addBankAccount($options = array())
    {
        $api = new Api\AddBankAccount();

        if(isset($options['merchantId'])){
            $api->setMerchantId($options['merchantId']);
        }
        if(isset($options['returnUrl'])){
            $api->setReturnUrl($options['returnUrl']);
        }
        if(isset($options['bankId'])){
            $api->setBankId($options['bankId']);
        }
        if (isset($options['paymentOptionId'])) {
            $api->setPaymentOptionId($options['paymentOptionId']);
        }

        $result = $api->doRequest();

        return isset($result['issuerUrl']) ? $result['issuerUrl'] : 'issuerUrl not found.';
    }
    
    /**
     * @param $options
     * @return bool
     */
    public static function suspend($options = array())
    {
        $api = new Api\Suspend();

        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }

        $result = $api->doRequest();

        return isset($result['result']) ? $result['result'] : false;
    }

    /**
     * @param $options
     * @return bool
     */
    public static function unsuspend($options = array())
    {
        $api = new Api\Unsuspend();

        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }

        $result = $api->doRequest();

        return isset($result['result']) ? $result['result'] : false;
    }

    /**
     * @param $options
     * @return bool
     */
    public static function setPackage($options = array())
    {
        $api = new Api\SetPackage();

        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }

        if (isset($options['package'])) {
            $api->setPackage($options['package']);
        }        

        $result = $api->doRequest();

        return isset($result['result']) ? $result['result'] : false;
    }

    /**
     * @param $options
     * @return bool
     */
    public static function markReady($options = array())
    {
        $api = new Api\MarkReady();

        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }

        $result = $api->doRequest();

        return !empty($result['request']['result']);
    }

    /**
     * @param $options
     * @return bool
     */
    public static function addClearing($options = array())
    {
        $api = new Api\AddClearing();

        if (isset($options['amount'])) {
            $api->setAmount($options['amount']);
        }

        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }

        if (isset($options['contentCategoryId'])) {
            $api->setContentCategoryId($options['contentCategoryId']);
        }

        $result = $api->doRequest();

        return !empty($result['request']['result']);
    }
}