<?php
require_once '../vendor/autoload.php';
require_once 'config.php';
try {
    $result = Paynl\Alliance\Document::upload(array(
        # Required
        'documentId' => 'D-3527-0371',
        'path' => array('C:\Users\username\Documents\test.png'),// you can just send a path, or an array of paths, the documents will be merged on our server
        'filename' => 'rekeningAfschrift.png' // optional, when you leave this blank, the filename from the path will be used
    ));

    var_dump($result->success());
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}