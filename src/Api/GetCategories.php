<?php

/**
 * Created by PhpStorm.
 * User: andy
 * Date: 14-1-2016
 * Time: 20:19
 */

namespace Paynl\Alliance\Api;


use Paynl\Error\Api as ApiError;
use Paynl\Helper;

class GetCategories extends Api
{
    protected $version = 4;

    /**
     * @var string The paymentOptionId
     */
    protected $paymentOptionId ;

    /**
     * @param int\null $paymentOptionId
     */
    public function setPaymentOptionId($paymentOptionId)
    {
        $this->paymentOptionId = $paymentOptionId;
    }

    protected function processResult($result)
    {
        $output = Helper::objectToArray($result);

        if (!is_array($output)) {
            throw new ApiError($output);
        }
        return $output;
    }

    public function getData()
    {
        if (isset($this->paymentOptionId)) {
            $this->data['paymentOptionId'] = $this->paymentOptionId;
        }
        return parent::getData();
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('service/getCategories');
    }
}
