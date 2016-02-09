<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 19:01
 */

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

    public function getPackageName()
    {
        return $this->data['packageName'];
    }

    public function getInvoiceAllowed()
    {
        return $this->data['invoiceAllowed'];
    }

    public function getPayoutInterval()
    {
        return $this->data['payoutInterval'];
    }

    public function getCreatedDate()
    {
        return $this->data['createdDate'];
    }

    public function getAcceptedDate()
    {
        return $this->data['acceptedDate'];
    }

    public function getDeletedDate()
    {
        return $this->data['deletedDate'];
    }

    public function getServices()
    {
        return $this->data['services'];
    }
}