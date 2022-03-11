<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 19:34
 */

namespace Paynl\Alliance\Api;


use Paynl\Error\Required;

class AddBankAccount extends Api
{
    protected $version = 7;

    protected $apiTokenRequired = true;
    protected $serviceIdRequired = false;

    /**
     * @var string The merchantId
     */
    protected $merchantId;
    /**
     * @var string The url we redirect the user to after the ideal is completed
     */
    protected $returnUrl;
    /**
     * @var int Optional, the bankid, if you omit this, we will ask the user for the bank
     */
    protected $bankId;
    /**
     * @var int Optional, the ID of the payment profile (standard iDEAL).
     */
    protected $paymentOptionId;

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @param string $returnUrl
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * @param int $bankId
     */
    public function setBankId($bankId)
    {
        $this->bankId = $bankId;
    }

    /**
     * @param int $paymentOptionId
     */
    public function setPaymentOptionId($paymentOptionId)
    {
        $this->paymentOptionId = $paymentOptionId;
    }


    protected function getData()
    {
        if(empty($this->merchantId)){
            throw new Required('merchantId');
        } else {
            $this->data['merchantId'] = $this->merchantId;
        }

        if(empty($this->returnUrl)){
            throw new Required('returnUrl');
        } else {
            $this->data['returnUrl'] = $this->returnUrl;
        }

        if(!empty($this->bankId)) {
            $this->data['bankId'] = $this->bankId;
        }

        if (!empty($this->paymentOptionId)) {
            $this->data['paymentOptionId'] = $this->paymentOptionId;
        }

        return parent::getData();
    }


    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('Alliance/addBankaccount');
    }
}