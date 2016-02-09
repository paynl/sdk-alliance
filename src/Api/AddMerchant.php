<?php

namespace Paynl\Alliance\Api;


use Paynl\Error\Error;
use Paynl\Error\Required;

use Paynl\Error\Api as ApiError;
use Paynl\Helper;

class AddMerchant extends Api
{
    /*
     * Company data
     */

    /**
     * @var string
     */
    private $_cocNumber;
    /**
     * @var string
     */
    private $_vatNumber;
    /**
     * @var string
     */
    private $_companyName;
    /**
     * @var string
     */
    private $_street;
    /**
     * @var string
     */
    private $_houseNumber;
    /**
     * @var string
     */
    private $_postalCode;
    /**
     * @var string
     */
    private $_city;
    /**
     * @var string
     */
    private $_countryCode;

    /*
     * Bank account data
     */

    /**
     * @var string
     */
    private $_bankAccountOwner;
    /**
     * @var string
     */
    private $_bankAccountNumber;
    /**
     * @var string
     */
    private $_bankAccountBic;

    /**
     *
     * @var sting day, week or month
     */
    private $_invoiceInterval;

    /**
     * @var string Alliance or AlliancePlus
     */
    private $_packageName;
    /*
     * Main account data
     */
    /**
     * @var string
     */
    private $_email;
    /**
     * @var string
     */
    private $_firstName;
    /**
     * @var string
     */
    private $_lastName;
    /**
     * @var string 'male' or 'female'
     */
    private $_gender;
    /**
     * @var int
     */
    private $_languageId = 1;
    /**
     * @var bool
     */
    private $_authorisedToSign;
    /**
     * @var bool
     */
    private $_ubo;

    /**
     * @var int 0 : No e-mail, 1 : Regular registration e-mail, 2: Short registration e-mail
     */
    private $_sendEmail;

    /**
     * Set to true if you want to be able to add a debit invoice to the account of this merchant.
     * Your invoice will be subtracted from the merchants account.
     * You will need to ask the merchant for permission before you can set this value to true
     *
     * @var bool
     */
    private $_settleBalance;

    /**
     * @var bool
     */
    private $_useCompanyAuth = true;
    /**
     * Array of signees, use the following format:
     * ['email']
     * ['firstname']
     * ['lastname']
     * ['authorised_to_sign'] 0: not authorised, 1:authorized to sign independently, 2: shared authorized to sign
     *
     * @var array Signees
     */
    private $_signees = array();

    /**
     * @param string $cocNumber
     */
    public function setCocNumber($cocNumber)
    {
        $this->_cocNumber = $cocNumber;
    }

    /**
     * @param string $vatNumber
     */
    public function setVatNumber($vatNumber)
    {
        $this->_vatNumber = $vatNumber;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->_companyName = $companyName;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->_street = $street;
    }

    /**
     * @param string $houseNumber
     */
    public function setHouseNumber($houseNumber)
    {
        $this->_houseNumber = $houseNumber;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->_postalCode = $postalCode;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        if (strlen($countryCode) != 2) {
            throw new Error('countryCode should be 2 characters long');
        }

        $this->_countryCode = strtoupper($countryCode);
    }

    /**
     * @param string $bankAccountOwner
     */
    public function setBankAccountOwner($bankAccountOwner)
    {
        $this->_bankAccountOwner = $bankAccountOwner;
    }

    /**
     * @param string $bankAccountNumber
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->_bankAccountNumber = $bankAccountNumber;
    }

    /**
     * @param string $bankAccountBic
     */
    public function setBankAccountBic($bankAccountBic)
    {
        $this->_bankAccountBic = $bankAccountBic;
    }

    /**
     * @param sting $invoiceInterval
     */
    public function setInvoiceInterval($invoiceInterval)
    {
        if (!in_array($invoiceInterval, array('day', 'week', 'month'))) {
            throw new Error("invoiceInterval is invalid. possible values: day, week or month");
        }

        $this->_invoiceInterval = $invoiceInterval;
    }

    /**
     * @param string $packageName
     */
    public function setPackageName($packageName)
    {
        $this->_packageName = $packageName;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        if (!in_array($gender, array('male', 'female'))) {

        }
        $this->_gender = $gender;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->_languageId = (int)$languageId;
    }

    /**
     * @param boolean $authorisedToSign
     */
    public function setAuthorisedToSign($authorisedToSign)
    {
        //TODO: The api only accepts true or false here, but should be 0, 1 or 2
        $this->_authorisedToSign = (bool)$authorisedToSign;
    }

    /**
     * @param boolean $ubo
     */
    public function setUbo($ubo)
    {
        $this->_ubo = (bool)$ubo;
    }

    /**
     * @param int $sendEmail
     */
    public function setSendEmail($sendEmail)
    {
        $this->_sendEmail = (int)$sendEmail;
    }

    /**
     * @param boolean $settleBalance
     */
    public function setSettleBalance($settleBalance)
    {
        $this->_settleBalance = (bool)$settleBalance;
    }

    /**
     * @param boolean $useCompanyAuth
     */
    public function setUseCompanyAuth($useCompanyAuth)
    {
        $this->_useCompanyAuth = (bool)$useCompanyAuth;
    }

    /**
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @param int $authorised_to_sign
     * @param bool $ubo
     * @throws Error
     */
    public function addSignee($email, $firstname, $lastname, $authorised_to_sign, $ubo)
    {
        if (!in_array($authorised_to_sign, array(0, 1, 2))) {
            throw new Error('authorised_to_sign can be 0, 1 or 2');
        }
        $signee = array(
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'authorised_to_sign' => $authorised_to_sign,
            'ubo' => $ubo //TODO: hier wordt nu nog niets mee gedaan
        );
        $this->_signees[] = $signee;
    }

    protected function getData()
    {
        if (isset($this->_email)) {
            $this->data['email'] = $this->_email;
        } else {
            throw new Required('email');
        }

        if (isset($this->_firstName)) {
            $this->data['firstName'] = $this->_firstName;
        } else {
            throw new Required('firstName');
        }

        if (isset($this->_lastName)) {
            $this->data['lastName'] = $this->_lastName;
        } else {
            throw new Required('lastName');
        }

        if (isset($this->_companyName)) {
            $this->data['companyName'] = $this->_companyName;
        } else {
            throw new Required('companyName');
        }

        if (isset($this->_cocNumber)) {
            $this->data['cocNumber'] = $this->_cocNumber;
        } else {
            throw new Required('cocNumber');
        }

        if (isset($this->_gender)) {
            $this->data['gender'] = $this->_gender;
        } else {
            throw new Required('gender');
        }

        if (isset($this->_street)) {
            $this->data['street'] = $this->_street;
        } else {
            throw new Required('street');
        }

        if (isset($this->_houseNumber)) {
            $this->data['houseNumber'] = $this->_houseNumber;
        } else {
            throw new Required('houseNumber');
        }

        if (isset($this->_postalCode)) {
            $this->data['postalCode'] = $this->_postalCode;
        } else {
            throw new Required('postalCode');
        }

        if (isset($this->_city)) {
            $this->data['city'] = $this->_city;
        } else {
            throw new Required('city');
        }

        if (isset($this->_countryCode)) {
            $this->data['countryCode'] = $this->_countryCode;
        }

        if (isset($this->_bankAccountOwner)) {
            $this->data['bankAccountOwner'] = $this->_bankAccountOwner;
        }
        if (isset($this->_bankAccountNumber)) {
            $this->data['bankAccountNumber'] = $this->_bankAccountNumber;
        }
        if (isset($this->_bankAccountBic)) {
            $this->data['bankAccountBIC'] = $this->_bankAccountBic;
        }
        if (isset($this->_vatNumber)) {
            $this->data['vatNumber'] = $this->_vatNumber;
        }
        if (isset($this->_languageId)) {
            $this->data['languageId'] = $this->_languageId;
        }
        if (isset($this->_authorisedToSign)) {
            $this->data['authorizedToSign'] = $this->_authorisedToSign;
        }
        if (isset($this->_ubo)) {
            $this->data['ubo'] = $this->_ubo;
        }
        if (isset($this->_useCompanyAuth)) {
            $this->data['useCompanyAuth'] = $this->_useCompanyAuth;
        }
        if (isset($this->_sendEmail)) {
            $this->data['sendEmail'] = $this->_sendEmail;
        }
        if (isset($this->_invoiceInterval)) {
            $this->data['invoiceInterval'] = $this->_invoiceInterval;
        }
        if (!empty($this->_signees)) {
            $this->data['signees'] = $this->_signees;
        }
        if (isset($this->_packageName)) {
            $this->data['packageName'] = $this->_packageName;
        }
        if (isset($this->_settleBalance)) {
            $this->data['settleBalance'] = (bool)$this->_settleBalance;
        }

        return parent::getData();
    }

    protected function processResult($result)
    {
        $output = Helper::objectToArray($result);
        if ($result == '') {
            throw new ApiError('Empty result');
        }
        if (!is_array($output)) {
            throw new ApiError($output);
        }

        // errors are returned different in this api
        if ($output['success'] != 1) {
            throw new ApiError($output['error_field'] . ' - ' . $output['error_message']);
        }
        return $output;
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('alliance/addMerchant');
    }

}