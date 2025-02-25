<?php

namespace App\Exceptions;

use Exception;

class RuntimeException extends Exception
{
    protected $message = "Application Error";
    protected $code = 500;
}