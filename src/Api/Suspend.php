<?php

namespace Paynl\Alliance\Api;

use Paynl\Error\Required;

class Suspend extends Api
{
    protected $version = 7;

    protected $apiTokenRequired = true;
    protected $serviceIdRequired = false;

    /**
     * @var string The merchantId
     */
    protected $merchantId;

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    protected function getData()
    {
        if (empty($this->merchantId)) {
            throw new Required('merchantId');
        } else {
            $this->data['merchantId'] = $this->merchantId;
        }
        return parent::getData();
    }


    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('Alliance/suspend');
    }
}
