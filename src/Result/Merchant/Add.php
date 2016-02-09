<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 16:45
 */

namespace Paynl\Alliance\Result\Merchant;


use Paynl\Result\Result;

class Add extends Result
{
    public function getMerchantId()
    {
        return $this->data['merchantId'];
    }

}