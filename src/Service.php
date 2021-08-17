<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 14-1-2016
 * Time: 19:02
 */

namespace Paynl\Alliance;


use Paynl\Alliance\Api;
use Paynl\Error\Required;


class Service
{
    public static function add($options)
    {
        $api = new Api\AddService();

        if (isset($options['merchantId'])) {
            $api->setMerchantId($options['merchantId']);
        }
        if (isset($options['name'])) {
            $api->setName($options['name']);
        }
        if (isset($options['description'])) {
            $api->setDescription($options['description']);
        }
        if (isset($options['categoryId'])) {
            $api->setCategoryId($options['categoryId']);
        }
        if (isset($options['url'])) {
            $api->setPublication($options['url']);
        }

        $exchange = [];
        if(isset($options['exchange'])){
            $exchange = $options['exchange'];
        }
        if (isset($options['alwaysSendExchange'])) {
            $exchange['alwaysSendExchange'] = $options['alwaysSendExchange'];
        }
        $api->setExchange($exchange);

        if (isset($options['extraUrls'])) {
            $api->setPublicationUrls($options['extraUrls']);
        }
        if (isset($options['paymentOptions'])) {
            $api->setPaymentOptions($options['paymentOptions']);
        }
        if (isset($options['pluginId'])) {
            $api->setPluginId($options['pluginId']);
        }
        if (isset($options['contactPhone'])) {
            $api->setContactPhone($options['contactPhone']);
        }

        $result = $api->doRequest();

        return new Result\Service\Add($result);
    }

    /**
     * Get website categories
     *
     * @param array $options
     * @return Result\Service\GetCategories
     */
    public static function getCategories($options = array())
    {
        $api = new Api\GetCategories();
        $result = $api->doRequest();

        return new Result\Service\GetCategories($result);
    }

    /**
     * get a list of available payment methods
     *
     * @param array $options
     * @return Result\Service\GetAvailablePaymentOptions
     * @throws Required
     */
    public static function getAvailablePaymentMethods($options = array())
    {
        $api = new Api\GetAvailablePaymentOptions();

        if (!isset($options['serviceId'])) {
            throw new Required('serviceId');
        } else {
            $api->setServiceId($options['serviceId']);
        }

        $result = $api->doRequest();

        return new Result\Service\GetAvailablePaymentOptions($result);
    }

    /**
     * Enable a payment method
     *
     * @param array $options
     * @return bool
     * @throws Required
     */
    public static function enablePaymentMethod($options = array())
    {
        $api = new Api\EnablePaymentOption();

        if (!isset($options['serviceId'])) {
            throw new Required('serviceId');
        } else {
            $api->setServiceId($options['serviceId']);
        }
        if (!isset($options['paymentMethodId'])) {
            throw new Required('paymentMethodId');
        } else {
            $api->setPaymentProfileId($options['paymentMethodId']);
        }
        if(isset($options['settings'])){
            $api->setSettings($options['settings']);
        }

        $result = $api->doRequest();
        return $result['request']['result'] == 1;
    }

    /**
     * Disable a payment method
     *
     * @param array $options
     * @return bool
     * @throws Required
     */
    public static function disablePaymentMethod($options = array())
    {
        $api = new Api\DisablePaymentOption();

        if (!isset($options['serviceId'])) {
            throw new Required('serviceId');
        } else {
            $api->setServiceId($options['serviceId']);
        }
        if (!isset($options['paymentMethodId'])) {
            throw new Required('paymentMethodId');
        } else {
            $api->setPaymentProfileId($options['paymentMethodId']);
        }


        $result = $api->doRequest();

        return $result['request']['result'] == 1;
    }
}