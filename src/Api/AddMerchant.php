<?php

namespace Paynl\Alliance\Api;


use Paynl\Error\Api as ApiError;
use Paynl\Helper;

class AddMerchant extends Api
{
    protected $version = 3;

    private $merchant;
    private $accounts;
    private $bankAccount;
    private $settings;

    /**
     * Set the merchant
     * Format:
     * array(
     *   name
     *   coc
     *   vat
     *   street
     *   houseNumber
     *   houseNumberAddition
     *   postalCode
     *   city
     *   countryCode
     * )
     * @param array $merchant
     */
    public function setMerchant($merchant)
    {
        $this->merchant = $merchant;
    }


    /**
     * Add an account
     * Format:
     * array(
     *   email
     *   firstname
     *   lastname
     *   gender
     *   authorizedToSign
     *   ubo
     *   uboPercentage
     *   useCompanyAuth
     *   hasAccess
     *   language
     * )
     * @param array $account
     */
    public function addAccount($account){
        $this->accounts[] = $account;
    }

    /**
     * Set the bankaccount
     * Format:
     * array(
     *   bankAccountOwner
     *   bankAccountNumber
     *   BankAccountBic
     * )
     * @param array $bankaccount
     */
    public function setBankAccount($bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    /**
     * Account settings
     * Format:
     * array(
     *   packageName
     *   sendEmail
     *   settleBalance
     *   referralProfileId
     *   clearingInterval
     * )
     * @param array $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }



    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('alliance/addMerchant');
    }

    protected function getData()
    {
        if(!empty($this->merchant)){
            $this->data['merchant'] = $this->merchant;
        }
        if(!empty($this->accounts)){
            $this->data['accounts'] = $this->accounts;
        }
        if(!empty($this->bankAccount)){
            $this->data['bankAccount'] = $this->bankAccount;
        }
        if(!empty($this->settings)){
            $this->data['settings'] = $this->settings;
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

}