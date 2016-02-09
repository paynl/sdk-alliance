<?php

namespace Paynl\Alliance\Api;

use Paynl\Error\Api as ApiError;
use Paynl\Helper;

class Api extends \Paynl\Api\Api
{
    protected $apiTokenRequired = true;
    protected $serviceIdRequired = false;

    protected $version = 2;


}