<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $message = "404 Not Found";
    protected $code = 404;
}