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

class GetMerchants extends Api
{
    /**
     * @var sting new, accepted or deleted
     */
    private $_state;


    /**
     * @param sting $state
     */
    public function setState($state)
    {
        if (!in_array($state, array('new', 'accepted', 'deleted'))) {
            throw new Error\Error("State can only be 'new', 'accepted' or 'deleted'");
        }
        $this->_state = $state;
    }


    protected function getData()
    {
        if (isset($this->_state)) {
            $this->data['state'] = $this->_state;
        }

        return parent::getData();
    }

    protected function processResult($result)
    {
        $output = Helper::objectToArray($result);

        if (!is_array($output)) {
            throw new Error\Api($output);
        }

        return $output;
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('alliance/getMerchants');
    }
}