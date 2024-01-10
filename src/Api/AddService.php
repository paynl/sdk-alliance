<?php

namespace Paynl\Alliance\Api;

use Paynl\Error\Required;

class AddService extends Api
{
    protected $version = 7;

    /**
     * @var string
     */
    private $_merchantId;
    /**
     * @var string
     */
    private $_name;
    /**
     * @var string
     */
    private $_description;
    /**
     * @var int the Category of the service use Paynl\Alliance\Service::getCategories to get a list
     */
    private $_categoryId;
    /**
     * @var string the publication url
     */
    private $_publication;
    /**
     * @var array Duplicate content urls
     */
    private $_publicationUrls = array();
    /**
     * @var array The enabled payment methods, with settings
     */
    private $_paymentOptions = array();
    private $_exchange;
    /**
     * @var string The scrambled plugin version ID which has the following format: PV-0000-0000
     */
    private $_pluginVersionId;
    /**
     * @var string A phone number that customers can use to contact the merchant
     */
    private $_contactPhone;

    /**
     * @param string $pluginVersionId
     */
    public function setPluginVersionId($pluginVersionId)
    {
        $this->_pluginVersionId = $pluginVersionId;
    }

    /**
     * @param string $contactPhone
     */
    public function setContactPhone($contactPhone)
    {
        $this->_contactPhone = $contactPhone;
    }

    /**
     * @param mixed $exchange
     */
    public function setExchange($exchange)
    {
        $this->_exchange = $exchange;
    }

    /**
     * @param string $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->_merchantId = $merchantId;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @param int $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->_categoryId = $categoryId;
    }

    /**
     * @param string $publication
     */
    public function setPublication($publication)
    {
        $this->_publication = $publication;
    }

    /**
     * @param array $publicationUrls
     */
    public function setPublicationUrls($publicationUrls)
    {
        $this->_publicationUrls = (array)$publicationUrls;
    }

    /**
     * @param array $paymentOptions
     */
    public function setPaymentOptions($paymentOptions)
    {
        $this->_paymentOptions = $paymentOptions;
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('alliance/addService');
    }

    protected function getData()
    {
        if (!isset($this->_merchantId)) {
            throw new Required('merchantId');
        }
        $this->data['merchantId'] = $this->_merchantId;

        if (!isset($this->_name)) {
            throw new Required('name');
        }
        $this->data['name'] = $this->_name;

        if (!isset($this->_description)) {
            throw new Required('description');
        }
        $this->data['description'] = $this->_description;

        if (!isset($this->_categoryId)) {
            throw new Required('categoryId');
        }
        $this->data['categoryId'] = $this->_categoryId;

        if (!isset($this->_publication)) {
            throw new Required('publication');
        }
        $this->data['publication'] = $this->_publication;

        if (!empty($this->_publicationUrls)) {
            $this->data['publicationUrls'] = $this->_publicationUrls;
        }
        if (!empty($this->_paymentOptions)) {
            $this->data['paymentOptions'] = $this->_paymentOptions;
        }
        if (isset($this->_exchange)) {
            $this->data['exchange'] = $this->_exchange;
        }
        if (isset($this->_pluginVersionId)) {
            $this->data['pluginVersionId'] = $this->_pluginVersionId;
        }
        if (isset($this->_contactPhone)) {
            $this->data['contactPhone'] = $this->_contactPhone;
        }

        return parent::getData();
    }

    protected function processResult($result)
    {
        return parent::processResult($result);
    }
}