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
    protected $version = 1;

    protected function processResult($result)
    {
        $output = Helper::objectToArray($result);

        if (!is_array($output)) {
            throw new ApiError($output);
        }
        return $output;
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('service/getCategories');
    }
}