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
    protected $version = 2;

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

        return parent::getData();
    }


    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('Alliance/addInvoice');
    }
}