<?php

namespace Paynl\Alliance\Api;

use Paynl\Error\Api as ApiError;
use Paynl\Error\Required;
use Paynl\Helper;

class GetAvailablePaymentOptions extends Api
{
    protected $version = 4;

    protected $serviceId = null;

    protected function processResult($result)
    {
        $output = Helper::objectToArray($result);

        if (!is_array($output)) {
            throw new ApiError($output);
        }
        return $output;
    }

    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function getData()
    {
        if (!isset($this->serviceId)) {
            throw new Required('serviceId');
        }
        $this->data['serviceId'] = $this->serviceId;

        return parent::getData();
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('service/getAvailablePaymentOptions');
    }
}