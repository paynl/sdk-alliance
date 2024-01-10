<?php

namespace Paynl\Alliance\Result\Merchant;

use Paynl\Result\Result;

class Merchant extends Result
{
    public function getMerchantId()
    {
        return $this->data['merchantId'];
    }

    public function getMerchantName()
    {
        return $this->data['merchantName'];
    }

    /**
     * @return string
     */
    public function getPackageName()
    {
        return (!empty($this->data['packageName']) ? (string)$this->data['packageName'] : $this->getPackageType());
    }

    /**
     * @return string
     */
    public function getPackageType()
    {
        return (!empty($this->data['contract']['packageType']) ? (string)$this->data['contract']['packageType'] : '');
    }

    /**   
     * @return string
     */
    public function getInvoiceAllowed()
    {
        return $this->data['contract']['invoiceAllowed'];
    }

    /**   
     * @return string
     */
    public function getPayoutInterval()
    {
        return $this->data['contract']['payoutInterval'];
    }

    /**   
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->data['contract']['createdDate'];
    }

    /**   
     * @return string
     */
    public function getAcceptedDate()
    {
        return $this->data['contract']['acceptedDate'];
    }

    /**   
     * @return string
     */
    public function getDeletedDate()
    {
        return $this->data['contract']['deletedDate'];
    }

    public function getServices()
    {
        return $this->data['services'];
    }
}