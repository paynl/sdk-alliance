<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 13-1-2016
 * Time: 19:29
 */

namespace Paynl\Alliance;


use Paynl\Alliance\Result\Document\Upload;
use Paynl\Error\Error;
use Paynl\Error\Required;

class Document
{
    public static function upload($options)
    {
        $api = new Api\AddDocument();

        if (isset($options['path'])) {
            if (!file_exists($options['path'])) {
                throw new Error('path is invalid, file does not exist');
            }
            $content = file_get_contents($options['path']);
            $api->setContent(base64_encode($content));
        } else {
            throw new Required('path');
        }

        if (isset($options['filename'])) {
            $api->setFilename($options['filename']);
        } else {
            // We should use the filename from the path
            $pathinfo = pathinfo($options['path']);
            $api->setFilename($pathinfo['basename']);

        }

        if (isset($options['documentId'])) {
            $api->setDocumentId($options['documentId']);
        }


        $result = $api->doRequest();

        return new Upload($result);
    }
}