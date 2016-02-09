<?php
require_once '../vendor/autoload.php';
require_once 'config.php';
try {
    $result = Paynl\Alliance\Document::upload(array(
        'documentId' => 'D-1234-5678',
        'path' => '/path/to/the/file',
        'filename' => 'rekeningAfschrift.pdf' // optional, when you leave this blank, the filename from the path will be used
    ));

    var_dump($result->success());
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}