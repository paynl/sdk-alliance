<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 19:34
 */

namespace Paynl\Alliance\Api;


use Paynl\Error\Required;

class AddInvoice extends Api
{
    protected $version = 7;

    protected $apiTokenRequired = true;
    protected $serviceIdRequired = true;

    /**
     * @var string The merchantId
     */
    protected $merchantId;
    /**
     * @var string Your reference
     */
    protected $invoiceId;
    /**
     * @var int The amount of the invoice in cents
     */
    protected $amount;
    /**
     * @var string the descrition of the invoice
     */
    protected $description;
    /**
     * @var string Optional: the url to the invoice
     */
    protected $invoiceUrl;
    /**
     * @var boolean Whether the transaction should be backdated to yesterday 23:59:59
     */
    protected $makeYesterday;
    /**
     * @var string The first free value.
     */
    protected $extra1;
    /**
     * @var string The second free value.
     */
    protected $extra2;
    /**
     * @var string The third free value.
     */
    protected $extra3;
    /**
     * @var string The service id of the merchant to invoice.
     */
    protected $merchantServiceId;
    

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @param string $invoiceId
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $invoiceUrl
     */
    public function setInvoiceUrl($invoiceUrl)
    {
        $this->invoiceUrl = $invoiceUrl;
    }

    /**
     * @param boolean $makeYesterday
     */
    public function setMakeYesterday($makeYesterday)
    {
        $this->makeYesterday = $makeYesterday;
    }

    /**
     * @param string $extra1
     */
    public function setExtra1($extra1)
    {
        $this->extra1 = $extra1;
    }

    /**
     * @param string $extra2
     */
    public function setExtra2($extra2)
    {
        $this->extra2 = $extra2;
    }

    /**
     * @param string $extra3
     */
    public function setExtra3($extra3)
    {
        $this->extra3 = $extra3;
    }

    /**
     * @param string $merchantServiceId
     */
    public function setMerchantServiceId($merchantServiceId)
    {
        $this->merchantServiceId = $merchantServiceId;
    }


    protected function getData()
    {
        if(empty($this->merchantId)){
            throw new Required('merchantId');
        } else {
            $this->data['merchantId'] = $this->merchantId;
        }

        if(empty($this->invoiceId)){
            throw new Required('invoiceId');
        } else {
            $this->data['invoiceId'] = $this->invoiceId;
        }

        if(empty($this->amount)){
            throw new Required('amount');
        } else {
            $this->data['amount'] = $this->amount;
        }

        if(empty($this->description)){
            throw new Required('description');
        } else {
            $this->data['description'] = $this->description;
        }

        if(isset($this->invoiceUrl)){
            $this->data['invoiceUrl'] = $this->invoiceUrl;
        }

        if(isset($this->makeYesterday)){
            $this->data['makeYesterday'] = (bool)$this->makeYesterday;
        }

        if(isset($this->extra1)){
            $this->data['extra1'] = $this->extra1;
        }

        if(isset($this->extra2)){
            $this->data['extra2'] = $this->extra2;
        }

        if(isset($this->extra3)){
            $this->data['extra3'] = $this->extra3;
        }

        if(isset($this->merchantServiceId)){
            $this->data['merchantServiceId'] = $this->merchantServiceId;
        }

        return parent::getData();
    }


    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('Alliance/addInvoice');
    }
}