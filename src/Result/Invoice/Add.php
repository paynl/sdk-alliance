<?php

namespace Paynl\Alliance\Result\Invoice;


use Paynl\Result\Result;

class Add extends Result
{
    public function referenceId()
    {
        return $this->data['referenceId'];
    }
}