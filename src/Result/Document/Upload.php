<?php

namespace Paynl\Alliance\Result\Document;


use Paynl\Result\Result;

class Upload extends Result
{
    public function success()
    {
        return (bool)$this->data['result'];
    }
}