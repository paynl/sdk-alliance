<?php

namespace Paynl\Alliance;

use Paynl\Alliance\Result\Document\Upload;
use Paynl\Error\Error;
use Paynl\Error\Required;

class Document
{
    /**
     * @param $path
     * @param Api\AddDocument $api
     * @return void
     * @throws Error
     */
    private static function addFile($path, Api\AddDocument $api)
    {
        if (!file_exists($path)) {
            throw new Error('path is invalid, file does not exist');
        }
        $content = file_get_contents($path);
        $api->addContent(base64_encode($content));
    }

    /**
     * @param $options
     * @return Upload
     * @throws Error
     * @throws Required
     * @throws Required\ApiToken
     * @throws \Paynl\Error\Api
     */
    public static function upload($options)
    {
        $api = new Api\AddDocument();

        if (isset($options['path'])) {
            if (is_string($options['path'])) {
                self::addFile($options['path'], $api);
            } elseif (is_array($options['path'])) {
                foreach ($options['path'] as $path) {
                    self::addFile($path, $api);
                }
            } else {
                throw new Error('path is invalid');
            }
        } else {
            throw new Required('path');
        }

        if (isset($options['filename'])) {
            $api->setFilename($options['filename']);
        } else {
            // We should use the filename from the path
            $path = $options['path'];
            if (is_array($path)) {
                $path = $path[0];
            }
            $pathinfo = pathinfo($path);
            $api->setFilename($pathinfo['basename']);
        }

        if (isset($options['documentId'])) {
            $api->setDocumentId($options['documentId']);
        }

        $result = $api->doRequest();

        return new Upload($result);
    }
}