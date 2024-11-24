<?php

namespace App\Exceptions;

use Exception;

class ImageFetchException extends Exception
{
    public function __construct($message = "Error fetching the image.", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
