<?php

namespace Paynl\Alliance\Api;

use Paynl\Error\Required;

class SetPackage extends Api
{
    protected $version = 7;

    protected $apiTokenRequired = true;
    protected $serviceIdRequired = false;

    /**
     * @var string The merchantId
     */
    protected $merchantId;

    /**
     * @var string The package to change to. 
     */
    protected $package;

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @param string $package
     */
    public function setPackage($package)
    {
        $this->package = $package;
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
        if (empty($this->package)) {
            throw new Required('package');
        } else {
            $this->data['package'] = $this->package;
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
        return parent::doRequest('Alliance/setPackage');
    }
}
