<?php

namespace Paynl\Alliance\Api;


use Paynl\Error\Required;

class AddClearing extends Api
{
    protected $version = 4;

    protected $apiTokenRequired = true;
    protected $serviceIdRequired = false;

    /**
     * @var string The amount
     */
    protected $amount;
    /**
     * @var string The merchantId
     */
    protected $merchantId;
    /**
     * @var string The contentCategoryId
     */
    protected $contentCategoryId;

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @param string $contentCategoryId
     */
    public function setContentCategoryId($contentCategoryId)
    {
        $this->contentCategoryId = $contentCategoryId;
    }

    protected function getData()
    {
        if (empty($this->amount)) {
            throw new Required('amount');
        } else {
            $this->data['amount'] = $this->amount;
        }

        if (isset($this->merchantId)) {
            $this->data['merchantId'] = $this->merchantId;
        }

        if (isset($this->contentCategoryId)) {
            $this->data['contentCategoryId'] = $this->contentCategoryId;
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
        return parent::doRequest('Merchant/addClearing');
    }
}
