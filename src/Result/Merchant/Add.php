<?php

namespace Paynl\Alliance\Result\Merchant;

use Paynl\Result\Result;

class Add extends Result
{
    public function getMerchantId()
    {
        return $this->data['merchantId'];
    }
}