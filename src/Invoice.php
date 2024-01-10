<?php

namespace Paynl\Alliance;

use Paynl\Error\Required;

class Invoice
{
    /**
     * Add an invoice for a merchant
     * With this method, you can add an invoice to the merchant to charge for your services
     * You can only add invoices to merchants, if you set the settleBalance to true when adding the merchant
     *
     * Options array
     * Required
     * merchantId - The merchant id of the merchant you want to create the invoice for
     * invoiceId - Your invoiceId
     * amount - The total amount of the invoice
     * description - The description of the invoice
     *
     * Optional
     * invoiceUrl - The url to the invoice, the merchant can use this to download the invoice
     * makeYesterday - Use this to create the invoice yesterday 23:59:59
     *
     * @param array $options See above
     * @throws Required
     */
    public static function add($options = array())
    {
        $api = new Api\AddInvoice();

        if (empty($options['merchantId'])) {
            throw new Required('merchantId');
        } else {
            $api->setMerchantId($options['merchantId']);
        }
        if (empty($options['invoiceId'])) {
            throw new Required('invoiceId');
        } else {
            $api->setInvoiceId($options['invoiceId']);
        }
        if (empty($options['amount'])) {
            throw new Required('amount');
        } else {
            $api->setAmount(round($options['amount'] * 100));
        }
        if (empty($options['description'])) {
            throw new Required('description');
        } else {
            $api->setDescription($options['description']);
        }
        if (isset($options['invoiceUrl'])) {
            $api->setInvoiceUrl($options['invoiceUrl']);
        }
        if (isset($options['makeYesterday']) && $options['makeYesterday'] == true) {
            $api->setMakeYesterday(true);
        } else {
            $api->setMakeYesterday(false);
        }
        if (isset($options['extra1'])) {
            $api->setExtra1($options['extra1']);
        }
        if (isset($options['extra2'])) {
            $api->setExtra2($options['extra2']);
        }
        if (isset($options['extra3'])) {
            $api->setExtra3($options['extra3']);
        }
        if (isset($options['merchantServiceId'])) {
            $api->setMerchantServiceId($options['merchantServiceId']);
        }

        $result = $api->doRequest();

        $result = new Result\Invoice\Add($result);

        return $result;
    }

}