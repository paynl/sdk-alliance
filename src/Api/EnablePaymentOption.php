<?php

namespace Paynl\Alliance\Api;

use Paynl\Error\Api as ApiError;

use Paynl\Error\Required;
use Paynl\Helper;

class EnablePaymentOption extends Api
{
    protected $version = 4;

    protected $serviceId = null;
    protected $paymentProfileId = null;
    protected $settings = null;

    protected function processResult($result)
    {
        $output = Helper::objectToArray($result);

        if (!is_array($output)) {
            throw new ApiError($output);
        }

        if (isset($output['request']['result']) && $output['request']['result'] == 0) {
            throw new ApiError($output['request']['errorMessage']);
        }
        return $output;
    }

    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function setPaymentProfileId($paymentProfileId)
    {
        $this->paymentProfileId = $paymentProfileId;
    }

    public function setSettings(array $settings)
    {
        $this->settings = $settings;
    }

    public function getData()
    {
        if (!isset($this->serviceId)) {
            throw new Required('serviceId');
        }
        $this->data['serviceId'] = $this->serviceId;

        if (!isset($this->paymentProfileId)) {
            throw new Required('paymentProfileId');
        }
        $this->data['paymentProfileId'] = $this->paymentProfileId;

        if (isset($this->settings)) {
            $this->data['settings'] = $this->settings;
        }

        return parent::getData();
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('service/enablePaymentOption');
    }
}