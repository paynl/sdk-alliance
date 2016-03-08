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
    private static function addFile($path, Api\AddDocument $api){
        if (!file_exists($path)) {
            throw new Error('path is invalid, file does not exist');
        }
        $content = file_get_contents($path);
        $api->addContent(base64_encode($content));
    }

    public static function upload($options)
    {
        $api = new Api\AddDocument();

        if (isset($options['path'])) {
            if(is_string($options['path'])){
                self::addFile($options['path'], $api);
            } elseif(is_array($options['path'])){
                foreach($options['path'] as $path){
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
            if(is_array($path)){
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