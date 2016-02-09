<?php
require_once '../vendor/autoload.php';
require_once 'config.php';

try {
    $categories = Paynl\Alliance\Service::getCategories();
    $data = $categories->getData();

    var_dump($data);
} catch (Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}

