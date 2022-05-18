<?php

namespace Paynl\Alliance\Api;

use Paynl\Error\Required;

class Unsuspend extends Api
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

    /**
     * @return array
     * @throws Error\Required
     */
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
     * @param null|string $endpoint
     * @param null|int $version
     * @return array
     */
    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('Alliance/unsuspend');
    }
}
