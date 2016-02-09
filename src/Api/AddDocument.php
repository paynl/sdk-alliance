<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 19:34
 */

namespace Paynl\Alliance\Api;


use Paynl\Error\Required;
use Paynl\Error\Api as ApiError;
use Paynl\Helper;

class AddDocument extends Api
{
    protected $version = 1;

    /**
     * @var string
     */
    private $_documentId;
    /**
     * @var string
     */
    private $_filename;
    /**
     * @var string base64 encoded content of the document
     */
    private $_content;

    /**
     * @param string $documentId
     */
    public function setDocumentId($documentId)
    {
        $this->_documentId = $documentId;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->_filename = $filename;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->_content = $content;
    }

    protected function getData()
    {
        if (!isset($this->_filename)) {
            throw new Required('filename');
        }
        $this->data['filename'] = $this->_filename;

        if (!isset($this->_documentId)) {
            throw new Required('documentId');
        }
        $this->data['documentId'] = $this->_documentId;

        if (!isset($this->_content)) {
            throw new Required('content');
        }
        $this->data['documentFile'] = $this->_content;

        return parent::getData();
    }

    protected function processResult($result)
    {

        $output = Helper::objectToArray($result);

        // errors are returned different in this api
        if (isset($output['result']) && $output['result'] == 0) {
            throw new ApiError($output['errorId'] . ' - ' . $output['errorMessage']);
        }

        return $output;
    }

    public function doRequest($endpoint = null, $version = null)
    {
        return parent::doRequest('document/add');
    }
}