<?php

namespace Paynl\Alliance\Result\Service;

use Paynl\Result\Result;

class Add extends Result
{
    public function getServiceId()
    {
        return $this->data['serviceId'];
    }
}