<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 17:50
 */

namespace Paynl\Alliance\Api;


use Paynl\Error;
use Paynl\Helper;

class GetMerchant extends Api
{
    /**
     * @var sting
     */
    private $_merchantId;

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->_merchantId = $merchantId;
    }

    protected function getData()
    {
        if (!isset($this->_merchantId)) {
            throw new Error\Required('merchantId');
        }

        $this->data['merchantId'] = $this->_merchantId;

        return parent::getData();
    }

    protected function processResult($result)
    {
        $output = Helper::objectToArray($result);

        if (isset($output['status']) && $output['status'] == 'FALSE') {
            throw new Error\Api($output['error']);
        }

        return parent::processResult($result);
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('alliance/getMerchant');
    }
}