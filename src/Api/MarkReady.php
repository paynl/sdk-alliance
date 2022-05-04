<?php

namespace Paynl\Alliance\Api;


use Paynl\Error\Required;

class MarkReady extends Api
{
    protected $version = 4;

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

    /**
     * @param $endpoint
     * @param $version
     * @return mixed
     */
    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('Merchant/markReady');
    }


}