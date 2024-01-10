<?php

namespace Paynl\Alliance\Result\Merchant;

use Paynl\Result\Result;

class GetList extends Result
{
    /**
     * @return Merchant[]
     */
    public function getMerchants()
    {
        $arrResult = array();
        foreach ($this->data as $arrMerchant) {
            $merchant = new Merchant($arrMerchant);
            array_push($arrResult, $merchant);
        }
        return $arrResult;
    }
}